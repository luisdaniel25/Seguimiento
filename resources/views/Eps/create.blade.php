@extends('adminlte::page')

@section('title', 'Crear EPS')


@section('content_header')
    <h1>Crear Registro Nuevo</h1>
@stop



@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro</h3>
                </div>

                <form action="{{ route('eps.store') }}" method="POST">
                    @csrf

                    <div class="card-body">


                        <div class="form-group">
                            <label for="numdoc">Numero Documento *</label>
                            <input type="number" class="form-control @error('numdoc') is-invalid @enderror" id="numdoc"
                                name="numdoc" value="{{ old('numdoc') }}" required>

                            @error('numdoc')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="denominacion">Denominacion *</label>
                            <input type="text" class="form-control @error('denominacion') is-invalid @enderror"
                                id="denominacion" name="denominacion" value="{{ old('denominacion') }}" required>

                            @error('denominacion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="observaciones">Observaciones *</label>
                            <input type="text" class="form-control @error('observaciones') is-invalid @enderror"
                                id="observaciones" name="observaciones" value="{{ old('observaciones') }}" required>

                            @error('observaciones')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('eps.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Guardar Ente Conformador
                            </button>
                        </div>

                </form>

            </div>

        </div>
    </div>

@stop
@include('sweetalert::alert')
