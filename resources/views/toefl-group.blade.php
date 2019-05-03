 @extends('layouts.app', ['background' => 'gray'])

@section('title', 'Grupo TOEFL')

@section('content')

<div class="row">
	<div class="col-xl">

		{{-- Card que muestra la información del grupo --}}
		@component('components.card')
			@slot('header', 'Información básica')
			@slot('class', 'mb-4')
			
			<form action="{{ route('toefl') }}/modificar" method="post" name="editGroupForm">

				{{csrf_field()}}

				<div class="form-row"> {{--fecha y hora --}}
					<div class="col">
						@component('components.form-input')
						@slot('tag', 'Fecha de aplicación')
						@slot('name', 'date')
						@slot('disabled', 'true')
						@slot('type', 'date')
						@slot('class', 'bg-white')
						@slot('value', $group->date)
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
						@slot('tag', 'Hora de aplicación')
						@slot('name', 'time')
						@slot('disabled', 'true')
						@slot('type', 'time')
						@slot('class', 'bg-white')
						@slot('value', $group->time)
						@endcomponent
					</div>
					
				</div>

				<div class="form-row"> {{--responsable y aplicador--}}
					<div class="col">
						<div class="form-group">
							<label for="responsableControlInput">Responsable</label>
							<select class="form-control bg-white" id="responsableControlInput" name="responsableId" disabled>
								<option value="0" {{ is_null($group->responsableUser) ? 'selected' : '' }}>Profesor no asignado</option>
								@foreach($professors as $professor)
								<option value="{{$professor->id}}" {{ !is_null($group->responsableUser) && $group->responsableUser->id == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="applicatorControlInput">Aplicador</label>
							<select class="form-control bg-white" id="applicatorControlInput" name="applicatorId" disabled>
								<option value="0" {{ is_null($group->applicatorUser) ? 'selected' : '' }}>Profesor no asignado</option>
								@foreach($professors as $professor)
								<option value="{{$professor->id}}" {{ !is_null($group->applicatorUser) && $group->applicatorUser->id == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
								@endforeach
							</select>
						</div>
					</div>{{--fecha de --}}
				</div>
 
				<div class="form-row">  {{--capacidad, aula, estado--}}
				
					<div class="form-group col-3">			
							<label for="capacityControlInput">Capacidad</label>
							<input id="capacityControlInput" name="capacity" type="number" class="form-control bg-white" min="1" max="50" disabled value={{$group->capacity}}>
							<div class="invalid-feedback"></div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="classroomControlInput">Aula</label>
							<select class="form-control bg-white" id="classroomControlInput" name="classroomId" disabled>
								<option value="0" {{ is_null($group->classroom) ? 'selected' : '' }}>Aula no asignada</option>
								@foreach($classrooms as $classroom)
								<option value="{{$classroom->id}}" {{ !is_null($group->classroom) && $group->classroom->id == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col"> 
						@component('components.form-input')
						@slot('tag', 'Estado')
						@slot('name', '')
						@slot('disabled', 'true')
						@slot('type', 'text')
						@slot('class', 'bg-white '.($group->applied ? '' : 'text-primary'))
						@slot('value', $group->applied ? 'Cerrado' : 'Abierto')
						@endcomponent
					</div>
				</div>

			<input  name="idGroup" value={{$group->id}} hidden>

				<input type="submit" id="submitFormButton" class="btn btn-primary float-right" value="Aplicar cambios" hidden>
			</form>


		@endcomponent
		
	</div>

	<div class="col-12 col-xl-6">

		{{-- Card que muestra las acciones para el grupo --}}
		@component('components.card')
			@slot('header', 'Acciones')
			@slot('class', 'mb-3')

			<div class="form-row">

				{{-- Botón para modificar el grupo --}}
				@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
					<div class="col-auto"><button id="editGroupButton" class="btn btn-secondary" onclick="formEditMode('editGroupForm'); deleteById('editGroupButton');">Editar grupo</button></div>
				@endif

				{{-- Botón para imprimir la lista de asistencia del grupo --}}
				<div class="col-auto"><a class="btn btn-secondary" href="{{ route('attendanceListsTOEFL', $group->id) }}" target="_blank">Imprimir lista de asistencia</a></div>

				

				{{-- Botón para eliminar el grupo --}}
				@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
					<div class="col-auto">
						<form action="/toefl/eliminar" method="post" name="deleteGroupForm">
							{{ csrf_field() }}
							<input type="hidden" name="idGroup" value="{{ $group->id }}">
							<!--<button type="submit" class="btn btn-danger">Eliminar alumno</button>-->
							<button class="btn btn-danger" data-toggle="confirmation">Eliminar grupo</button>
						</form>
					</div>
				@endif

				{{-- Botón para cerrar el grupo --}}
				@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
				{{-- Boton para alternar el grupo --}}
				<div class="col-auto">
					<form action="/toefl/alternar" method="post" name="toggleGroupForm">
						{{ csrf_field() }}
						<input type="hidden" name="groupId" value="{{ $group->id }}">
						<button class="btn btn-dark">{{ $group->applied ? 'Abrir' : 'Cerrar' }} grupo</button>
					</form>
				</div>
				@endif

			</div>
		@endcomponent

		{{-- Card que muestra los controles para agregar alumnos al grupo --}}
		@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
			@component('components.card')
				@slot('header', 'Agregar alumnos al grupo')
				@slot('class', 'mb-4')

				{{-- Input para agregar un nuevo alumno --}}
				<form action="/toefl/agregar" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="groupId" value="{{ $group->id }}">
					<div class="input-group">
					  <input id="studentAddInput" type="text" class="form-control" name="studentId" placeholder="ID del alumno..." autocomplete="off">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="submit">Agregar</button>
					  </div>
					</div>
					<div style="color: #dc3545; font-size: 80%;">{{ $errors->first('studentId') ? $errors->first('studentId') : '' }}</div>
				</form>

				<p class="text-center mt-3">Si usted presiona agregar, se agregará a <span id="studentToAdd" class="font-weight-bold">...</span> a este grupo.</p>
			@endcomponent
		@endif
	</div>
		
	<div class="col-12">

		{{-- Card que muestra los alumnos que están en el grupo --}}
		@component('components.card')
			@slot('header', 'Alumnos del grupo')
			@slot('class', 'mb-3')

<form method="post" action="{{ route('toefl-results')}}">

	@if($group->applied==false)
	<button class="btn btn-primary mb-3 float-right" type="submit">Aplicar calificaciones</button>
	@endif
	{{ csrf_field() }}
	<input type="hidden" name="groupId" value="{{ $group->id }}">

			@if(count($group->students) > $group->capacity)
				@component('components.alert')
					@slot('type', 'danger')
					El número de alumnos de este grupo es de {{ count($group->students) }} pero su capacidad es de {{ $group->capacity }}. Por favor, para evitar errores en el sistema, elimine al menos {{ count($group->students) - $group->capacity }} alumno(s) del grupo.
				@endcomponent
			@endif

			{{-- Tabla que muestra que alumnos están en este grupo --}}
			@component('components.toefl-students')
				@slot('group', $group)
				@slot('score', $score)
			 
			@endcomponent

	@if($group->applied==false)
	<button class="btn btn-primary mb-3 float-right" type="submit">Aplicar calificaciones</button>
	@endif	
			</form>
		@endcomponent
	</div>


@endsection

@section('scripts')

<script type="text/javascript">

	//Este script es para hacer la búsqueda en vivo del nombre del alumno,
	//deacuerdo al ID escrito en el input para agregar nuevos alumnos.
	$('#studentAddInput').on('input',function(){

		//Borrar el texto actual
		$('#studentToAdd').html('...');

		//Obtener el valor del input
		$value=$(this).val();

		//Si no hay valor, establecerlo como un -1 para no obtener una URL indeseada
		if(!$value){ $value = -1; }

		//Iniciar la petición con AJAX
		$.ajax({
			type : 'get',
			url : '{{ route('students') }}/control/' + $value,
			data:{ 'json':1, },

			//Poner el nombre del alumno en el span
			success:function(data){ 
				$('#studentToAdd').html(data['last_names'] + ' ' + data['first_names'] + ' (' + data['id'] + ')'); 
			},
			error:function(data){ 
				$('#studentToAdd').html('[alumno no encontrado]');
			}
		});
	})


</script>

<script type="text/javascript">

	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

@endsection