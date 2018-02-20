@extends('layouts.app')

@section('title', 'Bienvenido')

@section('section', 'Alumnos')

@section('content')

<div class="row">

    <!--Botones para manipular estudiantes-->
    <a href="" class="btn btn-primary">Agregar</a>
    <a href="" class="btn btn-secondary">Eliminar seleccionados</a>
    <a href="" class="btn btn-secondary">Modificar seleccionados</a>
</div>

<div class="row">

    <!--Formulario para ingresar un nuevo estudiante-->
    <!--<form class="form-inline">
        <div class="form-group">
            <label for="controlNumberControlInput">Número de control</label>
            <input type="text" class="form-control" id="controlNumberControlInput">

            <label for="firstNamesControlInput">Nombre(s)</label>
            <input type="text" class="form-control" id="firstNamesControlInput">
        </div>
    </form>-->

    <!--Tabla de estudiantes-->
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Número de control</th>
            <th>Nombre(s)</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
        </tr>

    <!--Imprimir un renglón dentro de la tabla para cada estudiante-->
    @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->control_number }}</td>
            <td>{{ $student->first_names }}</td>
            <td>{{ $student->fathers_last_name }}</td>
            <td>{{ $student->mothers_last_name }}</td>
        </tr>
    @endforeach
    </table>
</div>
@endsection