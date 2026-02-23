@extends('adminlte::page')

@section('title', 'Listado de Fichas de Caracterización')

@section('content_header')
    <h1>Fichas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('Fichas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Ficha de Caracterización
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Cupo</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($fichasdecaracterizacion as $ficha)
                        <tr>
                            <td>{{ $ficha->NIS }}</td>
                            <td>{{ $ficha->Codigo }}</td>
                            <td>{{ $ficha->Denominacion }}</td>
                            <td>{{ $ficha->Cupo }}</td>
                            <td>{{ $ficha->Observaciones }}</td>

                            {{-- ACCIONES --}}
                            <td>
                                <a href="{{ route('Fichas.show', $ficha->NIS) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('Fichas.edit', $ficha) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('Fichas.destroy', $ficha->NIS) }}" method="POST"
                                    style="display:inline;" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                No hay fichas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINACIÓN --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $fichasdecaracterizacion->links() }}
            </div>
        </div>
    </div>
@stop

@include('sweetalert::alert')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Confirmación eliminar
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Mensaje éxito
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

        });
    </script>
@stop
