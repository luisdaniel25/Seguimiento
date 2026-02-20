@extends('adminlte::page')

@section('title', 'Regionales')

{{-- HEADER SUPERIOR --}}
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Regionales</h1>

        <a href="{{ route('regionales.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nueva Regional
        </a>
    </div>
@stop


{{-- CONTENIDO PRINCIPAL --}}
@section('content')

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NIS</th>
                            <th>Código</th>
                            <th>Denominación</th>
                            <th>Observaciones</th>
                            <th width="250">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($regionales as $regional)
                            <tr>
                                <td>{{ $regional->NIS }}</td>
                                <td>{{ $regional->Codigo }}</td>
                                <td>{{ $regional->Denominacion }}</td>
                                <td>{{ $regional->Observaciones ?? 'Sin observaciones' }}</td>
                                <td>

                                    <a href="{{ route('regionales.show', $regional) }}" class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('regionales.edit', $regional) }}" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('regionales.destroy', $regional) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar esta regional?')">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No hay regionales registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-3">
                {{ $regionales->links() }}
            </div>

        </div>
    </div>

@stop
