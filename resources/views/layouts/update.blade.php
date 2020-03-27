@extends('layouts.plantilla')

@section('title','crear registro')

@section('content')
    <h1>Registros</h1>
    <form method="POST" action="/inicio">
        @method('PUT')
        @csrf

        <input name="nombre" placeholder="Nombre" type="text" class="form-control" value="">
        <input name="salario" placeholder="Salario" type="text" class="form-control" value="">
        <button class="btn-primary" type="submit">Actualizar</button>
    </form>
@endsection
