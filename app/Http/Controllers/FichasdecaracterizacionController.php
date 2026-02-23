<?php

namespace App\Http\Controllers;

use App\Models\Fichadecaracterizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FichasdecaracterizacionController extends Controller
{
    /**
     * Listado
     */
    public function index()
    {
        $fichasdecaracterizacion = Fichadecaracterizacion::paginate(10);

        Log::info('Listado Fichas de Caracterización cargado', [
            'total_registros' => $fichasdecaracterizacion->total(),
        ]);

        return view('Fichas.index', compact('fichasdecaracterizacion'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        Log::info('Formulario create Ficha abierto');
        return view('Fichas.create');
    }

    /**
     * Guardar nueva ficha
     */
    public function store(Request $request)
    {
        Log::info('Datos recibidos STORE Ficha', $request->all());

        $data = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_fichadecaracterizacion,Codigo',
            'Denominacion' => 'required|string|max:255',
            'Cupo' => 'required|integer|min:1',
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date|after:FechaInicio',
            'Observaciones' => 'nullable|string',
        ]);

        $ficha = Fichadecaracterizacion::create($data);

        Log::info('Ficha creada correctamente', [
            'NIS' => $ficha->NIS,
            'Codigo' => $ficha->Codigo,
        ]);

        return redirect()
            ->route('Fichas.index')
            ->with('success', 'Ficha creada correctamente');
    }

    /**
     * Mostrar ficha
     */
    public function show(Fichadecaracterizacion $Ficha)
    {
        return view('Fichas.show', [
            'fichadecaracterizacion' => $Ficha
        ]);
    }

    /**
     * Formulario editar
     */
    public function edit(Fichadecaracterizacion $Ficha)
    {
        Log::info('Abriendo edición para Ficha', [
            'NIS' => $Ficha->NIS
        ]);

        return view('Fichas.edit', [
            'fichadecaracterizacion' => $Ficha
        ]);
    }

    /**
     * Actualizar ficha
     */
    public function update(Request $request, Fichadecaracterizacion $Ficha)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_fichadecaracterizacion,Codigo,' . $Ficha->NIS . ',NIS',
            'Denominacion' => 'required|string|max:255',
            'Cupo' => 'required|integer|min:1',
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date|after_or_equal:FechaInicio',
            'Observaciones' => 'nullable|string',
        ]);

        $Ficha->update($data);

        Log::info('Ficha actualizada', [
            'NIS' => $Ficha->NIS
        ]);

        return redirect()
            ->route('Fichas.index')
            ->with('success', 'Ficha actualizada correctamente');
    }

    /**
     * Eliminar ficha
     */
    public function destroy(Fichadecaracterizacion $Ficha)
    {
        $nisEliminado = $Ficha->NIS;

        $Ficha->delete();

        Log::warning('Ficha eliminada', [
            'NIS' => $nisEliminado
        ]);

        return redirect()
            ->route('Fichas.index')
            ->with('success', 'Ficha eliminada correctamente');
    }
}
