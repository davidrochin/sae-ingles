@extends('layouts.app', ['background' => 'gray'])

@section('title', 'TOEFL grupo')

@section('content')

<div class="row">
	<div class="col-xl">

		{{-- Card que muestra la información del grupo --}}
		@component('components.card')
			@slot('header', 'Información básica')
			@slot('class', 'mb-4')
			
			<form action="{{ route('toefl') }}/modificar" method="post" name="editGroupForm">

				{{csrf_field()}}
 
			<div class="form-row">
									
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Fecha de aplicación')
							@slot('name', 'date')
							@slot('type', 'date(Y-m-d)')
							@slot('value', $group->date)
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Hora de aplicación')
							@slot('name', 'time')
							@slot('type', 'time')
							@slot('value', $group->time)
						@endcomponent
					</div>
				</div>
				<div class="form-row">
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
							<label for="professorControlInput">Aplicador</label>
							<select class="form-control bg-white" id="professorControlInput" name="professorId" disabled>
								<option value="0" {{ is_null($group->applicatorUser) ? 'selected' : '' }}>Profesor no asignado</option>
								@foreach($professors as $professor)
								<option value="{{$professor->id}}" {{ !is_null($group->applicatorUser) && $group->applicatorUser->id == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
				</div> <!--fin div row contenedor de responsable y aplicador -->
				

				<div class="form-row">
					
					<div class="form-group">			
							<label for="capacityControlInput">Capacidad</label>
							<input id="capacityControlInput" name="capacity" type="number" class="form-control bg-white" min="1"  disabled value={{$group->capacity}}>
							<div class="invalid-feedback"></div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="responsableControlInput">Aula</label>
							<select class="form-control bg-white" id="classroomControlInput" name="classroomId" disabled>
								<option value="0" {{ is_null($group->classroom) ? 'selected' : '' }}>Aula no asignada</option>
								@foreach($classrooms as $classroom)
								<option value="{{$classroom->id}}" {{ !is_null($group->classroom) && $group->classroom->id == $classroom->id ? 'selected' : '' }}>

									{{ $classroom->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					

				</div>
					<input  name="idGroup" value={{$group->id}} hidden>

				<input type="submit" id="submitFormButton" class="btn btn-primary float-right" value="Aplicar cambios" hidden>
				</div>

				
				
			</form>
		@endcomponent
		
			
@endsection