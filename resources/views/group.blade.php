@extends('layouts.app')

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
	</div>
		
	{{-- Card que muestra los alumnos que están en el grupo --}}
	<div class="col">
		@component('components.card')
			@slot('header', 'Alumnos del grupo')
			@slot('class', 'mb-3')
			Alumno 1
			Alumno 2
		@endcomponent
	</div>
</div>

@endsection