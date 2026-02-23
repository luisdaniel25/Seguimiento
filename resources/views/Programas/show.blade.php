@extends('adminlte::page')

@section('title', 'Detalle Programa de Formación')

@section('content_header')
    <h1>Detalle del Programa de Formación</h1>
@stop

@section('content')
    <div class="card">

        {{-- Encabezado --}}
        <div class="card-header">
            <h3 class="card-title">
                {{ $programa->Denominacion }}
            </h3>
        </div>

        {{-- Información --}}
        <div class="card-body">

            <p><strong>NIS:</strong> {{ $programa->NIS }}</p>
            <p><strong>Código:</strong> {{ $programa->Codigo }}</p>
            <p><strong>Denominación:</strong> {{ $programa->Denominacion }}</p>
            <p><strong>Observaciones:</strong> {{ $programa->Observaciones ?? 'N/A' }}</p>

            <hr>

            {{-- Ficha de Caracterización --}}
            <p><strong>Ficha de Caracterización:</strong>
                @if ($programa->fichadecaracterizacion)
                    Ficha #{{ $programa->fichadecaracterizacion->NIS }}
                    <br>
                    <small>Denominación: {{ $programa->fichadecaracterizacion->Denominacion }}</small>
                    <br>
                    <small>Cupo: {{ $programa->fichadecaracterizacion->Cupo }}</small>
                @else
                    <span class="badge badge-danger">N/A</span>
                @endif
            </p>

            {{-- Aprendices Asignados --}}
            <p><strong>Aprendices Asignados:</strong>
                @if ($programa->aprendices && $programa->aprendices->count() > 0)
                    <ul>
                        @foreach ($programa->aprendices as $aprendiz)
                            <li>{{ $aprendiz->Nombres }} {{ $aprendiz->Apellidos }} (Documento: {{ $aprendiz->NumDoc }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <span class="badge badge-danger">No hay aprendices asignados</span>
                @endif
            </p>

            <hr>
            <p><strong>Fecha de Creación:</strong>
                {{ $programa->created_at ? $programa->created_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>
            <p><strong>Última Actualización:</strong>
                {{ $programa->updated_at ? $programa->updated_at->format('d-m-Y H:i:s') : 'N/A' }}
            </p>

        </div>

        {{-- Botones --}}
        <div class="card-footer">
            <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('programas.edit', $programa->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
@stop
