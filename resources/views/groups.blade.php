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
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Código')
							@slot('name', 'code')
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Nivel')
							@slot('name', 'level')
							@slot('type', 'number')
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
						@endcomponent
					</div>
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Hora de fin')
							@slot('name', 'scheduleEnd')
							@slot('type', 'time')
						@endcomponent
					</div>
				</div>

				@include('parts.days-checkboxes')

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
		<form class="form col-auto mr-0 ml-auto" action="/alumnos/" method="get">
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