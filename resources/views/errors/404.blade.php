@extends('layouts.auth')

@section('title', 'No se encuentra')

@section('content')

<p>La página a la cual ha tratado de ingresar no se ha encontrado en el sistema. Si cree que esto es un error, por favor comuníqueselo a un administrador.</p>
<button class="btn btn-primary float-right" onclick="window.history.back();">Volver atrás</button>

@endsection