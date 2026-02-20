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
     * Mostrar listado de aprendices
     */
    public function index()
    {
        $aprendices = Aprendice::with([
            'centrodeformacion',
            'eps',
            'programasdeformacion',
            'tiposdocumento',
        ])
            ->orderBy('NIS')
            ->paginate(10);

        return view('Aprendices.index', compact('aprendices'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $centros = Centrodeformacion::all();
        $listaEps = Eps::all();
        $programas = Programasdeformacion::all();
        $tiposdoc = Tiposdocumento::all();

        return view('Aprendices.create', compact('centros', 'listaEps', 'programas', 'tiposdoc'));
    }

    /**
     * Guardar nuevo aprendiz
     */
    public function store(Request $request)
    {
        $data = $request->validate([
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

        Aprendice::create($data);

        Alert::success('¡Creado!', 'El aprendiz se ha registrado correctamente.');

        return redirect()->route('aprendices.index');
    }

    /**
     * Mostrar detalle de un aprendiz
     */
    public function show(Aprendice $aprendice)
    {
        $aprendice->load([
            'centrodeformacion',
            'eps',
            'programasdeformacion',
            'tiposdocumento',
        ]);

        return view('Aprendices.show', compact('aprendice'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Aprendice $aprendice)
    {
        $centros = Centrodeformacion::all();
        $listaEps = Eps::all();
        $programas = Programasdeformacion::all();
        $tiposdoc = Tiposdocumento::all();

        return view('Aprendices.edit', compact('aprendice', 'centros', 'listaEps', 'programas', 'tiposdoc'));
    }

    /**
     * Actualizar aprendiz
     */
    public function update(Request $request, Aprendice $aprendice)
    {
        $data = $request->validate([
            'NumDoc' => 'required|integer|unique:tbl_aprendices,NumDoc,'.$aprendice->NIS.',NIS',
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

        $aprendice->update($data);

        Alert::info('¡Actualizado!', 'El aprendiz se ha modificado correctamente.');

        return redirect()->route('aprendices.index');
    }

    /**
     * Eliminar aprendiz
     */
    public function destroy(Aprendice $aprendice)
    {
        $aprendice->delete();

        Alert::warning('¡Eliminado!', 'El aprendiz se ha eliminado correctamente.');

        return redirect()->route('aprendices.index');
    }
}
