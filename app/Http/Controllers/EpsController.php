<?php

namespace App\Http\Controllers;

use App\Models\Eps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class EpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eps = Eps::paginate(10);

        // DEBUG
        Log::info('Listado EPS cargado', [
            'total_registros' => $eps->total(),
        ]);

        return view('Eps.index', compact('eps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Eps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ver qué llega del formulario
        Log::info('Datos recibidos STORE', $request->all());

        $data = $request->validate([
            'numdoc' => 'required|integer|unique:tbl_eps,numdoc',
            'denominacion' => 'required|string|max:100',
            'observaciones' => 'required|string|max:200',
        ]);

        Log::info('Datos validados STORE', $data);

        $nuevo = Eps::create($data);

        Log::info('Registro creado correctamente', [
            'nis' => $nuevo->nis,
            'denominacion' => $nuevo->denominacion,
            'observaciones' => $nuevo->observaciones,
        ]);

        Alert::success('¡Creado!', 'El Ente Conformador se ha registrado correctamente.');

        return redirect()->route('eps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Eps $eps)
    {
        return view('Eps.show', compact('eps'));
    }

    public function edit(Eps $eps)
    {
        return view('Eps.edit', compact('eps'));
    }

    public function update(Request $request, Eps $eps)
    {
        Log::info('Datos recibidos UPDATE', $request->all());

        $data = $request->validate([
            'numdoc' => 'required|integer|unique:tbl_eps,NumDoc,'.$eps->NIS.',NIS',
            'denominacion' => 'required|string|max:100',
            'observaciones' => 'required|string|max:200',
        ]);

        $eps->update($data);

        Log::info('Registro actualizado', [
            'nis' => $eps->nis,
        ]);

        Alert::info('¡Actualizado!', 'La EPS se ha modificado correctamente.');

        return redirect()->route('eps.index');
    }

    public function destroy(Eps $eps)
    {
        Log::warning('Registro eliminado', [
            'NIS' => $eps->NIS,
            'Empresa' => $eps->denominacion,
        ]);

        $eps->delete();

        Alert::warning('¡Eliminado!', 'La EPS se ha eliminado correctamente.');

        return redirect()->route('eps.index');
    }
}
