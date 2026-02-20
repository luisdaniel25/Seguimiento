@extends('adminlte::page')

@section('title', 'Centros de Formación')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Centros de Formación</h1>

        <a href="{{ route('centros.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nuevo Centro
        </a>
    </div>
@stop

@section('content')

    {{-- MENSAJE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    {{-- TABLA --}}
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Listado de Centros
                <span class="badge badge-info">
                {{ $centros->total() }} registros
            </span>
            </h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Dirección</th>
                    <th>Observaciones</th>
                    <th>Regional</th>
                    <th width="160">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($centros as $centro)
                    <tr>
                        <td>{{ $centro->NIS }}</td>
                        <td>{{ $centro->Codigo }}</td>
                        <td>{{ $centro->Denominacion }}</td>
                        <td>{{ $centro->Direccion }}</td>
                        <td>{{ $centro->Observaciones ?? 'Sin observaciones' }}</td>
                        <td>
                            {{ $centro->regionale?->Denominacion ?? 'N/A' }}
                        </td>

                        <td>
                            <div class="btn-group">

                                {{-- VER --}}
                                <a href="{{ route('centros.show', $centro->NIS) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDITAR --}}
                                <a href="{{ route('centros.edit', $centro->NIS) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- ELIMINAR --}}
                                <form action="{{ route('centros.destroy', $centro->NIS) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar este centro?');"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No hay centros registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if($centros->hasPages())
            <div class="card-footer">
                {{ $centros->links() }}
            </div>
        @endif

    </div>

@stop
