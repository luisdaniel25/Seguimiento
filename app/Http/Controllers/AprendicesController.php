<?php

namespace App\Http\Controllers;

use App\Models\Aprendice;
use App\Models\Centrodeformacion;
use App\Models\Eps;
use App\Models\Programasdeformacion;
use App\Models\Tiposdocumento;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AprendicesController extends Controller
{
    /**
     * Listado
     */
    public function index()
    {
        $aprendices = Aprendice::with([
            'centrodeformacion',
            'eps',
            'programasdeformacion',
            'tiposdocumento'
        ])
            ->orderBy('NIS')
            ->paginate(10);

        return view('Aprendices.index', compact('aprendices'));
    }

    /**
     * Formulario creación
     */
    public function create()
    {
        $centros   = Centrodeformacion::all();
        $listaEps  = Eps::all();
        $programas = Programasdeformacion::all();
        $tiposdoc  = Tiposdocumento::all();

        return view('Aprendices.create', compact(
            'centros',
            'listaEps',
            'programas',
            'tiposdoc'
        ));
    }

    /**
     * Guardar registro
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_aprendices,NumDoc',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'CorreoPersonal' => 'required|email|max:50',
            'Sexo' => 'required|integer',
            'FechaNac' => 'required|date',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_programasdeformacion_NIS' => 'required|integer|exists:tbl_programasdeformacion,NIS',
            'tbl_centrodeformacion_NIS' => 'required|integer|exists:tbl_centrodeformacion,NIS',
            'tbl_eps_nis' => 'required|integer|exists:tbl_eps,nis',
        ]);

        // Crear registro
        Aprendice::create($validated);

        // Alerta éxito (igual que Regional)
        Alert::success('Muy Bien', 'Aprendiz creado exitosamente.');

        return redirect()->route('aprendices.index');
    }

    /**
     * Mostrar detalle
     */
    public function show(Aprendice $aprendice)
    {
        $aprendice->load([
            'centrodeformacion',
            'eps',
            'programasdeformacion',
            'tiposdocumento'
        ]);

        return view('Aprendices.show', compact('aprendice'));
    }

    /**
     * Formulario edición
     */
    public function edit(Aprendice $aprendice)
    {
        $centros   = Centrodeformacion::all();
        $listaEps  = Eps::all();
        $programas = Programasdeformacion::all();
        $tiposdoc  = Tiposdocumento::all();

        return view('Aprendices.edit', compact(
            'aprendice',
            'centros',
            'listaEps',
            'programas',
            'tiposdoc'
        ));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, Aprendice $aprendice)
    {
        $validated = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_aprendices,NumDoc,' . $aprendice->NIS . ',NIS',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'CorreoPersonal' => 'required|email|max:50',
            'Sexo' => 'required|integer|in:1,2',
            'FechaNac' => 'required|date',
            'tbl_tiposdocumentos_nis' => 'required|integer|exists:tbl_tiposdocumentos,nis',
            'tbl_programasdeformacion_NIS' => 'required|integer|exists:tbl_programasdeformacion,NIS',
            'tbl_centrodeformacion_NIS' => 'required|integer|exists:tbl_centrodeformacion,NIS',
            'tbl_eps_nis' => 'required|integer|exists:tbl_eps,nis',
        ]);

        $aprendice->update($validated);

        Alert::success('Muy Bien', 'Aprendiz actualizado exitosamente.');

        return redirect()->route('aprendices.index');
    }

    /**
     * Eliminar registro
     */
    public function destroy(Aprendice $aprendice)
    {
        $aprendice->delete();

        Alert::success('Muy Bien', 'Aprendiz eliminado exitosamente.');

        return redirect()->route('aprendices.index');
    }
}
