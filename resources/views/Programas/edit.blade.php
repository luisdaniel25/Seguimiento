@extends('adminlte::page')
@include('sweetalert::alert')

@section('title', 'Editar Programa de Formación')

{{-- HEADER --}}
@section('content_header')
    <h1>Editar Programa de Formación</h1>
@stop

{{-- CONTENIDO --}}
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-warning">

                <div class="card-header">
                    <h3 class="card-title">Modificar Información</h3>
                </div>

                <form action="{{ route('programas.update', $programa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Código --}}
                        <div class="form-group">
                            <label>Código *</label>
                            <input type="number" name="Codigo" class="form-control @error('Codigo') is-invalid @enderror"
                                value="{{ old('Codigo', $programa->Codigo) }}" required>

                            @error('Codigo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Denominación --}}
                        <div class="form-group">
                            <label>Denominación *</label>
                            <input type="text" name="Denominacion"
                                class="form-control @error('Denominacion') is-invalid @enderror"
                                value="{{ old('Denominacion', $programa->Denominacion) }}" required>

                            @error('Denominacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="Observaciones" class="form-control @error('Observaciones') is-invalid @enderror" rows="3">{{ old('Observaciones', $programa->Observaciones) }}</textarea>

                            @error('Observaciones')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        {{-- Ficha de Caracterización --}}
                        <div class="form-group">
                            <label>Ficha de Caracterización *</label>
                            <select name="tbl_fichadecaracterizacion_NIS"
                                class="form-control @error('tbl_fichadecaracterizacion_NIS') is-invalid @enderror" required>
                                <option value="">Seleccione una ficha...</option>
                                @foreach ($fichas as $ficha)
                                    <option value="{{ $ficha->NIS }}"
                                        {{ old('tbl_fichadecaracterizacion_NIS', $programa->tbl_fichadecaracterizacion_NIS) == $ficha->NIS ? 'selected' : '' }}>
                                        Ficha #{{ $ficha->NIS }} - {{ $ficha->Denominacion }}
                                        (Cupo: {{ $ficha->Cupo }})
                                    </option>
                                @endforeach
                            </select>
                            @error('tbl_fichadecaracterizacion_NIS')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Programa
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@stop

@include('sweetalert::alert')
