<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class ArchivoController
 *
 * Controlador responsable de la gestión completa del ciclo de vida
 * de archivos dentro del sistema.
 *
 * Funcionalidades principales:
 * - Listado paginado de archivos almacenados.
 * - Renderización del formulario de carga.
 * - Validación y almacenamiento seguro de archivos.
 * - Persistencia de metadatos en base de datos.
 * - Descarga controlada de archivos.
 * - Eliminación sincronizada entre almacenamiento físico y BD.
 *
 * Arquitectura aplicada:
 * - MVC (Model View Controller)
 * - Uso de Storage Facade (Filesystem abstraction)
 * - Transacciones ACID para integridad de datos
 *
 * Seguridad implementada:
 * - Validación MIME y tamaño
 * - Sanitización de nombres
 * - Identificadores UUID
 * - Prevención de archivos huérfanos
 *
 * @package App\Http\Controllers
 */
class ArchivoController extends Controller
{
    /**
     * Muestra el listado paginado de archivos registrados.
     *
     * Recupera los registros ordenados por fecha de creación
     * descendente utilizando el scope `latest()` de Eloquent.
     * Se aplica paginación para optimizar rendimiento y memoria.
     *
     * @return View Vista con colección paginada de archivos.
     */
    public function index(): View
    {
        $archivos = Archivo::latest()->paginate(10);

        return view('archivos.index', compact('archivos'));
    }

    /**
     * Renderiza el formulario de creación/subida de archivos.
     *
     * No ejecuta lógica de negocio; únicamente retorna la vista
     * responsable de la carga del archivo mediante HTTP POST.
     *
     * @return View Vista del formulario de carga.
     */
    public function create(): View
    {
        return view('archivos.create');
    }

    /**
     * Procesa y almacena un archivo enviado por el usuario.
     *
     * Flujo de ejecución:
     * 1. Valida el archivo recibido.
     * 2. Inicia transacción de base de datos.
     * 3. Sanitiza nombre original del archivo.
     * 4. Genera nombre único mediante UUID.
     * 5. Almacena físicamente el archivo en el disco público.
     * 6. Guarda metadatos en la base de datos.
     * 7. Confirma la transacción.
     *
     * En caso de error:
     * - Se revierte la transacción.
     * - Se elimina el archivo físico si fue creado.
     *
     * @param Request $request Petición HTTP con archivo y datos opcionales.
     *
     * @return RedirectResponse Redirección al listado con mensaje de estado.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'archivo' => [
                'required',
                'file',
                'max:10240', // 10MB
                'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif'
            ],
            'descripcion' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();

        try {

            /** @var \Illuminate\Http\UploadedFile $file */
            $file = $request->file('archivo');

            /**
             * Sanitiza el nombre original reemplazando caracteres inválidos.
             */
            $nombreOriginal = Str::of(
                $file->getClientOriginalName()
            )->replaceMatches('/[^A-Za-z0-9\.\-\_]/', '_');

            /**
             * Genera nombre único para almacenamiento seguro.
             */
            $nombreGuardado = Str::uuid() . '.' . $file->extension();

            /**
             * Guarda archivo en el filesystem configurado.
             */
            $ruta = $file->storeAs(
                'archivos',
                $nombreGuardado,
                'public'
            );

            /**
             * Persistencia de metadatos del archivo.
             */
            Archivo::create([
                'nombre_original' => $nombreOriginal,
                'nombre_guardado' => $nombreGuardado,
                'ruta' => $ruta,
                'tipo_mime' => $file->getMimeType(),
                'tamaño' => $file->getSize(),
                'descripcion' => $request->descripcion
            ]);

            DB::commit();

            return redirect()
                ->route('archivos.index')
                ->with('success', 'Archivo subido correctamente.');
        } catch (\Throwable $e) {

            DB::rollBack();

            /**
             * Evita inconsistencias eliminando archivos parcialmente guardados.
             */
            if (isset($ruta) && Storage::disk('public')->exists($ruta)) {
                Storage::disk('public')->delete($ruta);
            }

            return back()->with(
                'error',
                'Error al subir el archivo.'
            );
        }
    }

    /**
     * Descarga un archivo almacenado.
     *
     * Localiza el registro en la base de datos y utiliza el
     * sistema de almacenamiento de Laravel para transmitir
     * el archivo al cliente como descarga forzada.
     *
     * @param int $id Identificador del archivo.
     *
     * @return StreamedResponse Respuesta HTTP de descarga.
     */
    public function download($id)
    {
        $archivo = Archivo::findOrFail($id);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        return $disk->download(
            $archivo->ruta,
            $archivo->nombre_original
        );
    }

    /**
     * Elimina un archivo del sistema.
     *
     * Operaciones realizadas:
     * - Eliminación física del archivo en storage.
     * - Eliminación del registro en base de datos.
     * - Uso de transacción para garantizar consistencia.
     *
     * Si ocurre un error, la operación se revierte.
     *
     * @param int $id Identificador del archivo.
     *
     * @return RedirectResponse Redirección con resultado de operación.
     */
    public function destroy(int $id): RedirectResponse
    {
        $archivo = Archivo::findOrFail($id);

        DB::beginTransaction();

        try {

            if (Storage::disk('public')->exists($archivo->ruta)) {
                Storage::disk('public')->delete($archivo->ruta);
            }

            $archivo->delete();

            DB::commit();

            return back()->with('success', 'Archivo eliminado correctamente.');
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with('error', 'No se pudo eliminar el archivo.');
        }
    }
}
