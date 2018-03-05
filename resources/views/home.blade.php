@extends('layouts.app')

@section('title', 'Página principal')

@section('section', 'Página principal')

@section('content')

<p>Bienvenido(a) {{ Auth::user()->name }}. Puede navegar por las diferentes secciones del sistema usando el menú de la izquierda.</p>

@endsection
