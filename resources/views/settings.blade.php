@extends('layouts.app')
@section('title', 'Configuración')
@section('section', 'Configuración')

@section('content')

<!-- Modal para agregar una carrera -->
@component('components.modal')
@slot('id', 'newCareerModal')
@slot('title', 'Nueva carrera')
@slot('dismiss', 'Cancelar')

@slot('body')

<!-- Formulario de nueva carrera -->
<form class="form" action="/carreras/crear" method="post" id="createCareerForm">

  <!-- Crear el token de seguridad -->
  {{ csrf_field() }}

  @component('components.form-input')
  @slot('tag', 'Nombre')
  @slot('name', 'name')
  @slot('value', old('name'))
  @endcomponent

  @component('components.form-input')
  @slot('tag', 'Nombre corto')
  @slot('name', 'short_name')
  @slot('value', old('short_name'))
  @endcomponent

</form>



@endslot

@slot('footer')
<input type="submit" class="btn btn-primary" value="Crear"  form="createCareerForm">
@endslot
@endcomponent


<!-- Modal para agregar una aula-->
@component('components.modal')
@slot('id', 'newClassroomModal')
@slot('title', 'Nueva aula')
@slot('dismiss', 'Cancelar')

@slot('body')

<!-- Formulario de nueva carrera -->
<form class="form" action="/aulas/crear" method="post" id="createClassroomForm">

  <!-- Crear el token de seguridad -->
  {{ csrf_field() }}

  @component('components.form-input')
  @slot('tag', 'Nombre')
  @slot('name', 'name')
  @slot('value', old('name'))
  @endcomponent

</form>
@endslot

@slot('footer')
<input type="submit" class="btn btn-primary" value="Crear"  form="createClassroomForm">
@endslot
@endcomponent

<div class="card text-center">

  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" role="tablist">

      <li class="nav-item">
        <a id="careers-tab" role="tab" data-toggle="tab" aria-controls="nav-careers" class="nav-link active"
          href="#careers">Carreras</a>
      </li>

      <li class="nav-item">
        <a id="classrooms-tab" role="tab" data-toggle="tab" aria-controls="nav-classrooms" class="nav-link"
          href="#classrooms">Aulas</a>
      </li>

      <li class="nav-item">
        <a id="others-tab" role="tab" data-toggle="tab" class="nav-link" href="#">Otros</a>
      </li>
    </ul>
  </div>



      <div class="tab-content ">
        <div class="tab-pane active" id="careers">
            <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
            data-target="#newCareerModal">Nueva</button>
             </div>

         @include('tables.careers')
        </div>

        <div class="tab-pane" id="classrooms">
             <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
            data-target="#newClassroomModal">Nueva</button>
             </div>
         @include('tables.classrooms')
        </div>

        <div class="tab-pane" id="3">
          <h3>otros</h3>
        </div>
      </div>
  </div>



</div>

@endsection