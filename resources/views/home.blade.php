{{-- resources/views/home.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido al Dashboard</h1>
@stop

@section('content')
    <p>Este es el panel de control de tu aplicación de seguimiento de aprendices.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script>
        console.log('Dashboard cargado');
    </script>
@stop
