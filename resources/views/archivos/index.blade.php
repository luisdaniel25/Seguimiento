@extends('adminlte::page')

@section('title', 'Listado de Archivos')

@section('content_header')
    <h1>Archivos</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <a href="{{ route('archivos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Archivo
            </a>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Archivo</th>
                        <th>Tipo</th>
                        <th>Tamaño</th>
                        <th>Fecha</th>
                        <th width="160">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($archivos as $archivo)
                        <tr>

                            {{-- ARCHIVO --}}
                            <td>

                                {{-- Preview Imagen --}}
                                @if (Str::startsWith($archivo->tipo_mime, 'image'))
                                    <img src="{{ asset('storage/' . $archivo->ruta) }}" width="40" class="mr-2 rounded">
                                @else
                                    {{-- Iconos por tipo --}}
                                    @if (Str::contains($archivo->tipo_mime, 'pdf'))
                                        <i class="fas fa-file-pdf text-danger mr-2"></i>
                                    @elseif(Str::contains($archivo->tipo_mime, 'word'))
                                        <i class="fas fa-file-word text-primary mr-2"></i>
                                    @elseif(Str::contains($archivo->tipo_mime, 'excel'))
                                        <i class="fas fa-file-excel text-success mr-2"></i>
                                    @else
                                        <i class="fas fa-file text-secondary mr-2"></i>
                                    @endif
                                @endif

                                {{ $archivo->nombre_original }}

                                @if ($archivo->descripcion)
                                    <br>
                                    <small class="text-muted">
                                        {{ $archivo->descripcion }}
                                    </small>
                                @endif

                            </td>

                            {{-- TIPO --}}
                            <td>
                                <span class="badge badge-info">
                                    {{ $archivo->tipo_mime }}
                                </span>
                            </td>

                            {{-- TAMAÑO --}}
                            <td>{{ $archivo->tamano_formateado }}</td>

                            {{-- FECHA --}}
                            <td>{{ $archivo->created_at->format('d/m/Y') }}</td>

                            {{-- ACCIONES --}}
                            <td>

                                <a href="{{ route('archivos.download', $archivo->id) }}" class="btn btn-sm btn-info"
                                    title="Descargar">
                                    <i class="fas fa-download"></i>
                                </a>

                                <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST"
                                    style="display:inline;" class="form-eliminar">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay archivos registrados
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- PAGINACIÓN --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $archivos->links() }}
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
                        text: "El archivo será eliminado permanentemente.",
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
