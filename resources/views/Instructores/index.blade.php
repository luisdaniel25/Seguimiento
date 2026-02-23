@extends('adminlte::page')

@section('title', 'Listado de Instructores')

@section('content_header')
    <h1>Listado de Instructores</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-primary">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Instructores Registrados</h3>

                    <a href="{{ route('instructores.create') }}" class="btn btn-success">
                        Nuevo Instructor
                    </a>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th>NIS</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Correo Institucional</th>
                                    <th>Tipo Documento</th>
                                    <th>EPS</th>
                                    <th width="180">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($instructores as $instructor)
                                    <tr>
                                        <td>{{ $instructor->NIS }}</td>
                                        <td>{{ $instructor->NumDoc }}</td>
                                        <td>{{ $instructor->Nombres }}</td>
                                        <td>{{ $instructor->Apellidos }}</td>
                                        <td>{{ $instructor->Telefono }}</td>
                                        <td>{{ $instructor->CorreoInstitucional }}</td>

                                        <td>
                                            {{ $instructor->tiposdocumento->denominacion ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $instructor->eps->denominacion ?? 'N/A' }}
                                        </td>

                                        <td class="text-center">

                                            {{-- Ver --}}
                                            <a href="{{ route('instructores.show', $instructor->NIS) }}"
                                                class="btn btn-info btn-sm">
                                                Ver
                                            </a>

                                            {{-- Editar --}}
                                            <a href="{{ route('instructores.edit', $instructor->NIS) }}"
                                                class="btn btn-warning btn-sm">
                                                Editar
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('instructores.destroy', $instructor->NIS) }}"
                                                method="POST" class="d-inline form-eliminar">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No hay instructores registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    {{-- Paginación --}}
                    <div class="mt-3">
                        {{ $instructores->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>

@stop

@include('sweetalert::alert')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Confirmación eliminar (MISMA LÓGICA QUE APRENDICES)
            document.querySelectorAll('.form-eliminar').forEach(form => {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Deseas eliminar?',
                        text: "El instructor será eliminado del sistema.",
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
