@extends('layouts.app')
@section('title', 'Grupos')
@section('section', 'Grupos')

@section('content')

<div class="">

	<!--Modal-->
	@component('components.modal')
		@slot('id', 'newGroupModal')
		@slot('title', 'Nuevo grupo')
		@slot('dismiss', 'Cancelar')

		@slot('body')

			<!-- Formulario de nuevo grupo -->
			<form class="form" action="/grupos/crear" method="post" id="createGroupForm">

				{{ csrf_field() }}

				<div class="form-row">
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Nombre')
							@slot('name', 'name')
							@slot('value', old('name'))
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Código')
							@slot('name', 'code')
							@slot('value', old('code'))
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Nivel')
							@slot('name', 'level')
							@slot('type', 'number')
							@slot('value', old('level'))
						@endcomponent
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<div class="form-group">
		                    <label for="periodControlInput">Periodo</label>
		                    <select class="form-control" id="periodControlInput" name="periodId">
		                        @foreach(App\Period::all() as $period)
		                        <option value="{{$period->id}}" {{ old('periodId') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
		                        @endforeach
		                    </select>
		                    <div class="invalid-feedback">{{ $errors->first('periodId') }}</div>
		                </div>
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Año')
							@slot('name', 'year')
							@slot('type', 'number')
							@slot('value', old('year') != null ? old('year') : date('Y'))
						@endcomponent
					</div>
				</div>

				<div class="form-group">
                    <label for="professorControlInput">Profesor</label>
                    <select class="form-control" id="professorControlInput" name="professorId">
                        @foreach($professors as $professor)
                        <option value="{{$professor->id}}" {{ old('professorId') == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
                        @endforeach
                    </select>
                </div>

				<div class="form-row">
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Hora de inicio')
							@slot('name', 'scheduleStart')
							@slot('type', 'time')
							@slot('value', old('scheduleStart'))
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Hora de fin')
							@slot('name', 'scheduleEnd')
							@slot('type', 'time')
							@slot('value', old('scheduleEnd'))
						@endcomponent
					</div>
					<div class="col">
						<div class="form-group">
		                    <label for="classroomControlInput">Aula</label>
		                    <select class="form-control" id="classroomControlInput" name="classroomId">
		                        @foreach(App\Classroom::all() as $classroom)
		                        <option value="{{$classroom->id}}" {{ old('classroomId') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
		                        @endforeach
		                    </select>
		                </div>
					</div>
				</div>

				<div class="form-group has-error">
					<label for="mondayCheckbox">Días de la semana</label>
						<div class="card" style="{{ $errors->has('days') ? 'border-color: red;' : ''}}">
							<div class="card-body">
							@include('parts.days-checkboxes')
							</div>
						</div>
						<div style=" color: #dc3545; font-size: 80%; margin-top: .25rem;">{{ $errors->first('days') }}</div>
				</div>

			</form>
		@endslot

		@slot('footer')
			<input type="submit" class="btn btn-primary" value="Crear" form="createGroupForm">
		@endslot
	@endcomponent

	<!--Botones para manipular tabla y buscador-->
	<div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group" role="group" aria-label="First group">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newGroupModal">Nuevo</button>
		</div>

		<!-- Formulario para buscar -->
		<form class="form col-auto mr-0 ml-auto form-inline" action="/alumnos/" method="get">

			{{-- Filtros --}}
            <select class="form-control mr-3 ml-auto">
                <option>Todos los grupos</option>
                <option>Grupos activos</option>
                <option>Grupos inactivos</option>
                <option>Grupos sin profesor</option>
                <option>Grupos con cupo disponible</option>
                <option>Grupos llenos</option>
            </select>

			{{-- Buscador --}}
			<div class="input-group ">
				<input type="text" class="form-control w-auto" placeholder="Escriba algo..." value="{{ app('request')->input('keyword') }}" aria-describedby="btnGroupAddon" name="keyword">
				<div class="input-group-append">
					<button type="submit" class="btn btn-outline-secondary" type="button">Buscar</button>
				</div>
			</div>
		</form>
	</div>

</div>

<div class="">
	@include('tables.groups')

	<div class="row">
	    <div class="mx-auto">
	        {{ $groups->appends($_GET)->links('pagination::bootstrap-4') }}
	    </div>
	</div>
</div>

@endsection