@extends('layouts.app', ['background' => 'gray'])

@section('section', 'Información del grupo')

@section('content')

<div class="row">
	<div class="col-xl">

		{{-- Card que muestra la información del grupo --}}
		@component('components.card')
			@slot('header', 'Información básica')
			@slot('class', 'mb-4')
			
			<form action="{{ route('groups') }}/editar" method="post" name="editGroupForm">
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
				</div>

				<div class="form-row">
					<div class="col">
						<div class="form-group">
							<label for="periodControlInput">Periodo</label>
							<select class="form-control bg-white" id="periodControlInput" name="periodId" disabled>
								@foreach(App\Period::all() as $period)
								<option value="{{$period->id}}" {{ $group->period->id == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col">
						@component('components.form-input')
						@slot('tag', 'Año')
						@slot('name', 'year')
						@slot('disabled', 'true')
						@slot('class', 'bg-white')
						@slot('value', $group->year)
						@endcomponent
					</div>
				</div>

				<div class="form-group">
					<label for="professorControlInput">Profesor</label>
					<select class="form-control bg-white" id="professorControlInput" name="professorId" disabled>
						@foreach($professors as $professor)
						<option value="{{$professor->id}}" {{ $group->user->id == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-row">
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
			</form>

		@endcomponent

		{{-- Card que muestra las acciones para el grupo --}}
		@component('components.card')
			@slot('header', 'Acciones')
			@slot('class', 'mb-3')

			<div class="form-row">
				<div class="col-auto"><button class="btn btn-danger">Eliminar grupo</button></div>
				<!--<div class="col-auto"><button class="btn btn-danger">Vaciar grupo</button></div>-->
				<div class="col-auto"><button id="editGroupButton" class="btn btn-secondary" onclick="formEditMode('editGroupForm'); deleteById('editGroupButton');">Editar grupo</button></div>
				<div class="col-auto"><a class="btn btn-secondary" href="{{ route('attendanceLists', $group->id) }}">Imprimir lista de asistencia</a></div>
			</div>
		@endcomponent
		
	</div>
		
	<div class="col">

		{{-- Card que muestra los controles para agregar alumnos al grupo --}}
		@component('components.card')
			@slot('header', 'Agregar alumnos al grupo')
			@slot('class', 'mb-4')

			{{-- Input para agregar un nuevo alumno --}}
			<form action="/grupos/agregar" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="groupId" value="{{ $group->id }}">
				<div class="input-group mb-3">
				  <input id="studentAddInput" type="text" class="form-control" name="studentId" placeholder="Escriba el ID de un alumno para agregarlo a este grupo..." autocomplete="off">
				  <div class="input-group-append">
				    <button class="btn btn-outline-secondary" type="submit">Agregar</button>
				  </div>
				</div>
			</form>

			<p class="text-center">Si usted presiona agregar, se agregará a <span id="studentToAdd" class="font-weight-bold">...</span> a este grupo.</p>
		@endcomponent

		{{-- Card que muestra los alumnos que están en el grupo --}}
		@component('components.card')
			@slot('header', 'Alumnos del grupo')
			@slot('class', 'mb-3')

			{{-- Tabla que muestra que alumnos están en este grupo --}}
			@component('components.group-students')
				@slot('group', $group)
			@endcomponent
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


</script>

<script type="text/javascript">

	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

@endsection