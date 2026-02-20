@extends('adminlte::page')

@section('title', 'Listado Ente Conformador')

@section('content_header')
    <h1>Ente Conformador</h1>
@stop

@section('content')

    <div class="card">

        {{-- HEADER CARD --}}
        <div class="card-header">
            <a href="{{ route('enteconformador.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Número Documento</th>
                        <th>Razón Social</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo Institucional</th>
                        <th>Tipo Documento</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($enteconformador as $ente)
                        <tr>
                            <td>{{ $ente->NIS }}</td>
                            <td>{{ $ente->NumDoc }}</td>
                            <td>{{ $ente->RazonSocial }}</td>
                            <td>{{ $ente->Direccion }}</td>
                            <td>{{ $ente->Telefono }}</td>
                            <td>{{ $ente->CorreoInstitucional }}</td>

                            {{-- Tipo Documento --}}
                            <td>
                                @if ($ente->tiposdocumento)
                                    {{ $ente->tiposdocumento->denominacion }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                            </td>

                            {{-- Rol Administrativo --}}
                            <td>
                                @if ($ente->rolesadministrativo)
                                    {{ $ente->rolesadministrativo->Descripcion }} {{-- ✅ CORREGIDO: denominacion → Descripcion --}}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                            </td>

                            {{-- ACCIONES --}}
                            <td>
                                <a href="{{ route('enteconformador.show', $ente->NIS) }}" class="btn btn-sm btn-info"
                                    title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('enteconformador.edit', $ente->NIS) }}" class="btn btn-sm btn-warning"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('enteconformador.destroy', $ente->NIS) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Está seguro de eliminar?')" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                No hay registros de Ente Conformador
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINACIÓN --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $enteconformador->links() }}
            </div>

        </div>
    </div>

@stop

@include('sweetalert::alert')
