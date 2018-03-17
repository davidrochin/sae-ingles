@extends('layouts.app')

@section('section', 'Información del grupo')

@section('content')

<div class="row">
	<div class="col-xl">

		{{-- Card que muestra la información del grupo --}}
		@component('components.card')
			@slot('header', 'Información del grupo')
			@slot('class', 'mb-3')
			
			{{-- Información del grupo --}}

			<div class="form-row">
				<div class="col">
					@component('components.form-input')
						@slot('tag', 'Nombre')
						@slot('name', 'name')
						@slot('disabled', 'true')
						@slot('value', $group->name)
					@endcomponent
				</div>
				<div class="col">
					@component('components.form-input')
						@slot('tag', 'Código')
						@slot('name', 'code')
						@slot('disabled', 'true')
						@slot('value', $group->code)
					@endcomponent
				</div>
				<div class="col">
					@component('components.form-input')
						@slot('tag', 'Nivel')
						@slot('name', 'level')
						@slot('disabled', 'true')
						@slot('value', $group->level)
					@endcomponent
				</div>
			</div>

			<div class="form-group">
                <label for="professorControlInput">Profesor</label>
                <select class="form-control" id="professorControlInput" name="professorId" disabled>
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
						@slot('value', $group->schedule_start)
            		@endcomponent
            	</div>
            	<div class="col">
            		@component('components.form-input')
            			@slot('tag', 'Hora de fin')
						@slot('name', 'scheduleEnd')
						@slot('disabled', 'true')
						@slot('type', 'time')
						@slot('value', $group->schedule_end)
            		@endcomponent
            	</div>
            </div>

            <div class="form-group">
				<label for="mondayCheckbox">Días de la semana</label>
					<div class="card" style="{{ $errors->has('days') ? 'border-color: red;' : ''}} background-color: #e9ecef;">
						<div class="card-body">
						@component('components.days-checkboxes')
							@slot('group', $group)
							@slot('disabled', 'true')
						@endcomponent
						</div>
					</div>
					<div style=" color: #dc3545; font-size: 80%; margin-top: .25rem;">{{ $errors->first('days') }}</div>
			</div>
		@endcomponent

		{{-- Card que muestra los controles para agregar alumnos al grupo --}}
		@component('components.card')
			@slot('header', 'Agregar alumnos al grupo')

			{{-- Input para agregar un nuevo alumno --}}
			<form action="/grupos/agregar" method="post">
				<div class="input-group mb-3">
				  <input id="studentAddInput" type="text" class="form-control" name="studentId" placeholder="Escriba el ID de un alumno para agregarlo a este grupo...">
				  <div class="input-group-append">
				    <button class="btn btn-outline-secondary" type="submit">Agregar</button>
				  </div>
				</div>
			</form>

			@component('components.alert')
				@slot('id', 'studentInfoAlert')
				Si usted presiona agregar, se agregará a <span id="studentToAdd" class="font-weight-bold">...</span> a este grupo.
			@endcomponent
		@endcomponent
	</div>
		
	{{-- Card que muestra los alumnos que están en el grupo --}}
	<div class="col">
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

	// Buscar el input por su ID y establecer su evento
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