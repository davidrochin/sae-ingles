@extends('layouts.auth')

@section('title', 'No tiene permisos')

@section('content')

<p>Usted no tiene privilegios para ver/hacer esto. Si cree que esto es un error, por favor comuníquese con un administrador del sistema.</p>
<a class="btn btn-primary float-right" role="button" href="{{ route('home') }}">Página principal</a>

@endsection
