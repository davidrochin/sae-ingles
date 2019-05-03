@extends('layouts.app')
@section('title', ' Grupos TOEFL')
@section('section', 'TOEFL')

@section('content')

<div class="">
<!--Modal-->
	@component('components.modal')
		@slot('id', 'newGroupModal')
		@slot('title', 'Nuevo grupo TOEFL')
		@slot('dismiss', 'Cancelar')

		@slot('body')

			<!-- Formulario de nuevo grupo -->
			<form class="form" action="/toefl/crear-grupo" method="post" id="createGroupForm">

				{{ csrf_field() }}

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
				</div>

				
			</form>
		@endslot

		@slot('footer')
			<input type="submit" class="btn btn-primary" value="Crear" form="createGroupForm">
		@endslot
	@endcomponent


{{-- Botón de nuevo grupo --}}
	
			<div class="btn-group" role="group" aria-label="First group">
				<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newGroupModal">Nuevo</button>
			</div>


	<!--Botones para manipular tabla y buscador-->
	<div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">
    </div>

<div class="">
	@include('tables.groups-toefl')

	<div class="row">
	    <div class="mx-auto">
	        {{ $groups->appends($_GET)->links('pagination::bootstrap-4') }}
	    </div>
	</div>
</div>

@endsection
