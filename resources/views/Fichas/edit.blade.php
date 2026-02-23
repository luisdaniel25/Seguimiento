@extends('adminlte::page')

@section('title', 'Editar Ficha de Caracterización')

@section('content_header')
    <h1>Editar Ficha #{{ $fichadecaracterizacion->NIS }}</h1>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edición</h3>
                </div>

                <form action="{{ route('Fichas.update', $fichadecaracterizacion) }}" method="POST" class="form-guardar">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- NIS (solo lectura recomendado) --}}
                        <div class="form-group">
                            <label>NIS *</label>
                            <input type="text" name="NIS" class="form-control @error('NIS') is-invalid @enderror"
                                value="{{ old('NIS', $fichadecaracterizacion->NIS) }}" required {{-- readonly --}}
                                {{-- Opcional: si no quieres que editen el NIS --}}>

                            @error('NIS')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Codigo --}}
                        <div class="form-group">
                            <label>Código *</label>
                            <input type="number" name="Codigo" class="form-control @error('Codigo') is-invalid @enderror"
                                value="{{ old('Codigo', $fichadecaracterizacion->Codigo) }}" required>

                            @error('Codigo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Denominacion --}}
                        <div class="form-group">
                            <label>Denominación *</label>
                            <input type="text" name="Denominacion"
                                class="form-control @error('Denominacion') is-invalid @enderror"
                                value="{{ old('Denominacion', $fichadecaracterizacion->Denominacion) }}" required>

                            @error('Denominacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Cupo --}}
                        <div class="form-group">
                            <label>Cupo *</label>
                            <input type="number" name="Cupo" min="1"
                                class="form-control @error('Cupo') is-invalid @enderror"
                                value="{{ old('Cupo', $fichadecaracterizacion->Cupo) }}" required>

                            @error('Cupo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fecha Inicio --}}
                        <div class="form-group">
                            <label>Fecha Inicio *</label>
                            <input type="date" name="FechaInicio"
                                class="form-control @error('FechaInicio') is-invalid @enderror"
                                value="{{ old('FechaInicio', optional($fichadecaracterizacion->FechaInicio)->format('Y-m-d')) }}"
                                required>

                            @error('FechaInicio')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fecha Fin --}}
                        <div class="form-group">
                            <label>Fecha Fin *</label>
                            <input type="date" name="FechaFin"
                                class="form-control @error('FechaFin') is-invalid @enderror"
                                value="{{ old('FechaFin', optional($fichadecaracterizacion->FechaFin)->format('Y-m-d')) }}"
                                required>

                            @error('FechaFin')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="Observaciones" rows="3" class="form-control @error('Observaciones') is-invalid @enderror">{{ old('Observaciones', $fichadecaracterizacion->Observaciones) }}</textarea>

                            @error('Observaciones')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('Fichas.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Actualizar Ficha
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
                        title: '¿Deseas actualizar?',
                        text: "Se modificarán los datos de la ficha.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, actualizar',
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
