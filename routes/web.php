<?php

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Ruta raíz
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Dashboard protegido
Route::get('/home', [HomeController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Rutas protegidas por auth
Route::middleware(['auth'])->group(function () {

    // Módulo Aprendices
    Route::resource('aprendices', \App\Http\Controllers\AprendicesController::class);

    // Módulo Centros de Formación
    Route::resource('centros', \App\Http\Controllers\CentrodeformacionController::class);

    // Módulo Entes Conformadores
    Route::resource('enteconformador', \App\Http\Controllers\EnteconformadorController::class);

    // Módulo EPS
    Route::resource('eps', \App\Http\Controllers\EpsController::class);

    // Módulo Fichas de Caracterización
    Route::resource('Fichas', \App\Http\Controllers\FichasdecaracterizacionController::class);

    // Módulo Instructores
    Route::resource('instructores', \App\Http\Controllers\InstructoresController::class);

    // Módulo Programas de Formación
    Route::resource('programas', \App\Http\Controllers\ProgramasdeformacionController::class);

    // Módulo Regionales
    Route::resource('regionales', \App\Http\Controllers\RegionalesController::class);

    // Módulo Roles Administrativos
    Route::resource('rolesadministrativos', \App\Http\Controllers\RolesadministrativosController::class);

    // Módulo Tipos de Documento
    Route::resource('tiposdocumento', \App\Http\Controllers\TiposdocumentoController::class);

    Route::resource('usuarios', \App\Http\Controllers\UserController::class);

    
    Route::resource('archivos', ArchivoController::class);

    Route::get(
        'archivos/{id}/download',
        [ArchivoController::class, 'download']
    )->name('archivos.download');
});
