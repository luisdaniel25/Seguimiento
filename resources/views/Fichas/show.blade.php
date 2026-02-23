@extends('adminlte::page')

@section('title', 'Detalle Ficha de Caracterización')

@section('content_header')
    <h1>Detalle de la Ficha</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $fichadecaracterizacion->Denominacion }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $fichadecaracterizacion->NIS }}</p>

            <p><strong>Código:</strong>
                {{ $fichadecaracterizacion->Codigo }}
            </p>

            <p><strong>Denominación:</strong>
                {{ $fichadecaracterizacion->Denominacion }}
            </p>

            <p><strong>Cupo:</strong>
                {{ $fichadecaracterizacion->Cupo }}
            </p>

            {{-- Fechas --}}
            <p>
                <strong>Fecha Inicio:</strong>
                {{ $fichadecaracterizacion->FechaInicio
                    ? \Carbon\Carbon::parse($fichadecaracterizacion->FechaInicio)->format('d-m-Y')
                    : 'N/A' }}
            </p>

            <p>
                <strong>Fecha Fin:</strong>
                {{ $fichadecaracterizacion->FechaFin
                    ? \Carbon\Carbon::parse($fichadecaracterizacion->FechaFin)->format('d-m-Y')
                    : 'N/A' }}
            </p>

            <hr>

            <p><strong>Observaciones:</strong>
                {{ $fichadecaracterizacion->Observaciones ?? 'N/A' }}
            </p>

            <hr>

            <p><strong>Fecha de Creación:</strong>
                {{ $fichadecaracterizacion->created_at ? $fichadecaracterizacion->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

            <p><strong>Última Actualización:</strong>
                {{ $fichadecaracterizacion->updated_at ? $fichadecaracterizacion->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}


        <div class="card-footer">
            <a href="{{ route('Fichas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('Fichas.edit', $fichadecaracterizacion) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop
