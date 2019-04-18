@extends('layouts.app', ['background' => 'gray'])

@section('title', 'Mi Grupo')

@section('content')

<div class="row">
	<div class="col-12 col-xl-8 mb-4">

		{{-- Card que muestra la información del grupo --}}
		@component('components.card')
			@slot('header', 'Información básica')
			
			<div class="form-row">
				<div class="col">
					@component('components.form-input')
					@slot('tag', 'Nombre')
					@slot('name', 'name')
					@slot('disabled', 'true')
					@slot('class', 'bg-white')
					@slot('value', $group->name)
					@endcomponent
				</div>
				<div class="col">
					@component('components.form-input')
					@slot('tag', 'Código')
					@slot('name', 'code')
					@slot('disabled', 'true')
					@slot('class', 'bg-white')
					@slot('value', $group->code)
					@endcomponent
				</div>
				<div class="col">
					@component('components.form-input')
					@slot('tag', 'Nivel')
					@slot('name', 'level')
					@slot('disabled', 'true')
					@slot('class', 'bg-white')
					@slot('value', $group->level)
					@endcomponent
				</div>
				<div class="col">
					@component('components.form-input')
					@slot('tag', 'Hora de inicio')
					@slot('name', 'scheduleStart')
					@slot('disabled', 'true')
					@slot('type', 'time')
					@slot('class', 'bg-white')
					@slot('value', $group->schedule_start)
					@endcomponent
				</div>
				<div class="col">
					@component('components.form-input')
					@slot('tag', 'Hora de fin')
					@slot('name', 'scheduleEnd')
					@slot('disabled', 'true')
					@slot('type', 'time')
					@slot('class', 'bg-white')
					@slot('value', $group->schedule_end)
					@endcomponent
				</div>
			</div>

			<div class="form-group">
				<label for="mondayCheckbox">Días de la semana</label>
				<div class="card" style="{{ $errors->has('days') ? 'border-color: red;' : ''}}">
					<div class="card-body">
						@component('components.days-checkboxes')
						@slot('group', $group)
						@slot('disabled', 'true')
						@endcomponent
					</div>
				</div>
				<div style=" color: #dc3545; font-size: 80%; margin-top: .25rem;">{{ $errors->first('days') }}</div>
			</div>
			<input type="submit" id="submitFormButton" class="btn btn-primary float-right" value="Aplicar cambios" hidden>
		@endcomponent
		
	</div>
		
	<div class="col-12 col-xl-4 mb-4">
		{{-- Card que muestra las acciones para el grupo --}}
		@component('components.card')
			@slot('header', 'Acciones')
			@slot('class', 'h-100')

			<div class="row">
				<div class="col-12"><a class="btn btn-secondary w-100" href="{{ route('attendanceLists', $group->id) }}" target="_blank">Imprimir lista de asistencia</a></div>

			
			</div>
		@endcomponent
	</div>
</div>

<div class="row">
	<div class="col">

		{{-- Card que muestra los alumnos que están en el grupo --}}
		@component('components.card')
			@slot('header', 'Alumnos del grupo')
			@slot('class', 'mb-3')
		
			<form method="POST" action="{{ route('my-groups') }}/actualizar">
				<button class="btn btn-primary mb-3 float-right" type="submit">Aplicar calificaciones</button>
				
				{{-- Dropdown para poner la misma calificacion a todos --}}
				<div class="dropdown float-left">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Todos a
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a class="dropdown-item" onclick="setAllTo(0);">0</a>
				    <a class="dropdown-item" onclick="setAllTo(50);">50</a>
				    <a class="dropdown-item" onclick="setAllTo(70);">70</a>
				    <a class="dropdown-item" onclick="setAllTo(100);">100</a>
				  </div>
				</div>

				{{ csrf_field() }}
				<input type="hidden" name="groupId" value="{{ $group->id }}">

				{{-- Tabla que muestra que alumnos están en este grupo --}}
				@component('components.my-group-students')
					@slot('group', $group)
					@slot('gradesTable', $gradesTable)
					@slot('averages', $averages)
				@endcomponent

				<button class="btn btn-primary float-right" type="submit">Aplicar calificaciones</button>
			</form>
		@endcomponent

	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

	//Este script es para hacer la búsqueda en vivo del nombre del alumno,
	//deacuerdo al ID escrito en el input para agregar nuevos alumnos.
	$('#studentAddInput').on('input',function(){

		//Obtener el valor del input
		$value=$(this).val();

		//Si no hay valor, establecerlo como un -1 para no obtener una URL indeseada
		if(!$value){ $value = -1; }

		//Iniciar la petición con AJAX
		$.ajax({
			type : 'get',
			url : '{{ route('students') }}/' + $value,
			data:{ 'json':1, },

			//Poner el nombre del alumno en el span
			success:function(data){ $('#studentToAdd').html(data['last_names'] + ' ' + data['first_names']); },
			error:function(data){ $('#studentToAdd').html('...'); }
		});
	})

	function setAllTo(val){
		var inputs = document.getElementsByClassName('score-data');
		for (var i = 0; i < inputs.length; i++) {
			inputs[i].value = val;
		}
	}


</script>

<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

@endsection