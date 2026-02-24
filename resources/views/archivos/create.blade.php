@extends('adminlte::page')

@section('title', 'Subir Archivo')

@section('content_header')
    <h1>Registro de Archivo</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Carga</h3>
                </div>

                <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" class="form-guardar">

                    @csrf

                    <div class="card-body">

                        {{-- DESCRIPCIÓN --}}
                        <div class="form-group">
                            <label>Descripción</label>

                            <input type="text" name="descripcion"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                value="{{ old('descripcion') }}" placeholder="Descripción opcional">

                            @error('descripcion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- ARCHIVO --}}
                        <div class="form-group">
                            <label>Seleccionar Archivo *</label>

                            <div class="custom-file">
                                <input type="file" name="archivo"
                                    class="custom-file-input @error('archivo') is-invalid @enderror" required>

                                <label class="custom-file-label">
                                    Elegir archivo
                                </label>
                            </div>

                            @error('archivo')
                                <span class="text-danger d-block mt-1">
                                    {{ $message }}
                                </span>
                            @enderror

                            <small class="text-muted">
                                Permitidos: PDF, Word, Excel, Imágenes (Máx 10MB)
                            </small>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('archivos.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Subir Archivo
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop

@include('sweetalert::alert')

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Mostrar nombre archivo seleccionado (AdminLTE)
            const inputFile = document.querySelector('.custom-file-input');

            if (inputFile) {
                inputFile.addEventListener('change', function(e) {
                    let fileName = e.target.files[0].name;
                    e.target.nextElementSibling.innerText = fileName;
                });
            }

            // Confirmación SweetAlert
            document.querySelectorAll('.form-guardar').forEach(form => {

                form.addEventListener('submit', function(e) {

                    if (!form.checkValidity()) return;

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Deseas subir el archivo?',
                        text: "El archivo será almacenado en el sistema.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, subir',
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
