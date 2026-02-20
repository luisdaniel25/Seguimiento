@extends('adminlte::page')

@section('title', 'Listado EPS')

@section('content_header')
    <h1>EPS</h1>
@stop

@section('content')

    <div class="card">

        {{-- HEADER CARD --}}
        <div class="card-header">
            <a href="{{ route('eps.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Número Documento</th>
                        <th>Denominacion</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($eps as $ep)
                        <tr>
                            <td>{{ $ep->nis }}</td>
                            <td>{{ $ep->numdoc }}</td>
                            <td>{{ $ep->denominacion }}</td>
                            <td>{{ $ep->observaciones }}</td>

                            {{-- ACCIONES --}}
                            <td>
                                <a href="{{ route('eps.show', $ep->nis) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('eps.edit', $ep->nis) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('eps.destroy', $ep->nis) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Está seguro de eliminar?')" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                No hay registros de EPS disponibles.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINACIÓN --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $eps->links() }}
            </div>

        </div>
    </div>

@stop

@include('sweetalert::alert')
