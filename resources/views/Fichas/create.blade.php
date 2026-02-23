@extends('adminlte::page')

@section('title', 'Crear Ficha')

@section('content_header')
    <h1>Registro de Fichas</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('Fichas.store') }}" method="POST" class="form-guardar">
                    @csrf

                    <div class="card-body">

                        {{-- Codigo --}}
                        <div class="form-group">
                            <label>Codigo</label>
                            <input type="number" name="Codigo" class="form-control @error('Codigo') is-invalid @enderror"
                                value="{{ old('Codigo') }}" required>

                            @error('Codigo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Denominacion --}}
                        <div class="form-group">
                            <label>Denominacion</label>
                            <input type="text" name="Denominacion"
                                class="form-control @error('Denominacion') is-invalid @enderror"
                                value="{{ old('Denominacion') }}" required>

                            @error('Denominacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Cupo --}}
                        <div class="form-group">
                            <label>Cupo *</label>
                            <input type="number" name="Cupo" class="form-control @error('Cupo') is-invalid @enderror"
                                value="{{ old('Cupo') }}" min="1" required>

                            @error('Cupo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>>

                        {{-- Fecha Inicio --}}
                        <div class="form-group">
                            <label>Fecha Inicio *</label>
                            <input type="date" name="FechaInicio"
                                class="form-control @error('FechaInicio') is-invalid @enderror"
                                value="{{ old('FechaInicio') }}" required>

                            @error('FechaInicio')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fecha Fin --}}
                        <div class="form-group">
                            <label>Fecha Fin *</label>
                            <input type="date" name="FechaFin"
                                class="form-control @error('FechaFin') is-invalid @enderror" value="{{ old('FechaFin') }}"
                                required>

                            @error('FechaFin')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="Observaciones" class="form-control @error('Observaciones') is-invalid @enderror" rows="3">{{ old('Observaciones') }}</textarea>

                            @error('Observaciones')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div> {{-- FIN card-body --}}

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('Fichas.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar Ficha
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
            document.querySelectorAll('.form-guardar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) return;

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Deseas guardar?',
                        text: "Se registrará una nueva ficha.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, guardar',
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
