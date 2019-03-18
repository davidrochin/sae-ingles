@extends('layouts.app')
@section('title', 'Configuración')
@section('section', 'Configuración')

@section('content')

<div class="card text-center">

  <!-- Header -->
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">

      <li class="nav-item">
        <a class="nav-link active" href="#">Carreras</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">Aulas</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">Otros</a>
      </li>
    </ul>
  </div>

  <div class="card-body">
    @include('tables.careers')
  </div>
</div>
@endsection