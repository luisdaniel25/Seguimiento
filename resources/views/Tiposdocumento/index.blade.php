@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Tipos de Documento')

@section('content_header')
    <h1>Listado de Tipos de Documento</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('tiposdocumento.create') }}" class="btn btn-primary mb-3">Nuevo Tipo de Documento</a>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tipos de Documento Registrados</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Denominación</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos as $tipo)
                                <tr>
                                    <td>{{ $tipo->nis }}</td>
                                    <td>{{ $tipo->denominacion }}</td>
                                    <td>{{ $tipo->observaciones }}</td>
                                    <td>
                                        <a href="{{ route('tiposdocumento.show', $tipo->nis) }}"
                                            class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('tiposdocumento.edit', $tipo->nis) }}"
                                            class="btn btn-warning btn-sm">Editar</a>

                                        <form action="{{ route('tiposdocumento.destroy', $tipo->nis) }}" method="POST"
                                            class="d-inline form-eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $tipos->links() }}
                </div>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Deseas eliminar?',
                        text: "Este tipo de documento será eliminado.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@stop
