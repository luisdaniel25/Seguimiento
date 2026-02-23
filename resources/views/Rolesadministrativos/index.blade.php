@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Roles Administrativos')

@section('content_header')
    <h1>Listado de Roles Administrativos</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Roles Registrados</h3>
                    <a href="{{ route('rolesadministrativos.create') }}" class="btn btn-success btn-sm">
                        Nuevo Rol
                    </a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $rol)
                                <tr>
                                    <td>{{ $rol->NIS }}</td>
                                    <td>{{ $rol->Descripcion }}</td>
                                    <td>
                                        <a href="{{ route('rolesadministrativos.show', $rol->NIS) }}"
                                            class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('rolesadministrativos.edit', $rol->NIS) }}"
                                            class="btn btn-warning btn-sm">Editar</a>

                                        <form action="{{ route('rolesadministrativos.destroy', $rol->NIS) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Desea eliminar este rol?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No hay roles registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
