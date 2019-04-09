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
							@slot('value', old('date') != null ? old('date') : date('Y-m-d'))
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Hora de aplicación')
							@slot('name', 'time')
							@slot('type', 'time')
							@slot('value', old('time'))
						@endcomponent
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
	                    <label for="professorControlInput">Aplicador</label>
	                    <select class="form-control" id="professorControlInput" name="aplicadorId">
	                    	<option value="" {{ old('aplicadorId') == 0 ? 'selected' : '' }}></option>
	                        @foreach($professors as $professor)
	                        <option value="{{$professor->id}}" {{ old('aplicadorId') == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
	                        @endforeach
	                    </select>
	                    <div class="invalid-feedback">{{ $errors->first('aplicadorId') }}</div>
               		</div>

               		<div class="form-group col">
	                    <label for="professorControlInput">Responsable</label>
	                    <select class="form-control" id="professorControlInput" name="responsableId">
	                    	<option value="" {{ old('responsableId') == 0 ? 'selected' : '' }}></option>
	                        @foreach($professors as $professor)
	                        <option value="{{$professor->id}}" {{ old('responsableId') == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
	                        @endforeach
	                    </select>
	                    <div class="invalid-feedback">{{ $errors->first('responsableId') }}</div>
               		</div>

				</div>
				

				<div class="form-row">
					
					<div class="form-group col-4">						
							<label for="capacityControlInput">Capacidad</label>
							<input id="capacityControlInput" name="capacity" type="number" class="form-control  " min="1" max="50" value={{old('capacity') != null ? old('capacity') : '40'}}>
							<div class="invalid-feedback"></div>						
					</div>
					<div class="col">
						<div class="form-group">
		                    <label for="classroomControlInput">Aula</label>
		                    <select class="form-control" id="classroomControlInput" name="classroomId">
		                    	<option value="" {{ old('classroomId') }}></option>
		                        @foreach(App\Classroom::all() as $classroom)
		                        <option value="{{$classroom->id}}" {{ old('classroomId') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
		                        @endforeach
		                    </select>
		                    <div class="invalid-feedback">{{ $errors->first('classroomId') }}</div>
		                </div>
					</div>
					<input  name="idGroup" value={{$group->id}} hidden>

				<input type="submit" id="submitFormButton" class="btn btn-primary float-right" value="Aplicar cambios" hidden>
				</div>

				
				
			</form>
		@endcomponent
		
			
@endsection