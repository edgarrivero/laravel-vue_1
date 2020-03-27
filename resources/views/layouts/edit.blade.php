@extends('layouts.plantilla')

@section('title','Editar registro')

@section('content')
    <h1>Registros</h1>
    <form method="POST" action="/inicio/{{$profesor->id}}">
        @method('PUT')
        @csrf

        <input name="nombre" placeholder="Nombre" type="text" class="form-control" value="{{$profesor->nombre}}">
        <input name="salario" placeholder="Salario" type="text" class="form-control" value="{{$profesor->salario}}">
        <button class="btn btn-primary" type="submit">Actualizar</button>

    </form>
    <form action="/inicio/{{$profesor->id}}" method="POST">
        @method('DELETE')
        @csrf

        <button class="btn btn-danger" type="submit">Eliminar</button>
    </form>
@endsection
