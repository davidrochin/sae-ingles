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
				{{--		@component('components.form-input')
							@slot('tag', 'Nivel')
							@slot('name', 'level')
							@slot('type', 'number')
							@slot('value', old('level'))
						@endcomponent --}}

					
						<label for="levelControlInput">Nivel</label>
							<input id="nivelControlInput" name="level" type="number" class="form-control  " min="1" max="10" value={{old('level')}}/>
							<div class="invalid-feedback"></div>		
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
				<div class="form-row">
					<div class="form-group col">
	                    <label for="professorControlInput">Profesor</label>
	                    <select class="form-control" id="professorControlInput" name="professorId">
	                    	<option value="" {{ old('professorId') == 0 ? 'selected' : '' }}></option>
	                        @foreach($professors as $professor)
	                        <option value="{{$professor->id}}" {{ old('professorId') == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
	                        @endforeach
	                    </select>
	                    <div class="invalid-feedback">{{ $errors->first('professorId') }}</div>
               		</div>
					<div class="form-group col-4">						
							<label for="capacityControlInput">Capacidad</label>
							<input id="capacityControlInput" name="capacity" type="number" class="form-control  " min="1" max="50" value={{old('capacity') != null ? old('capacity') : '40'}}>
							<div class="invalid-feedback"></div>						
					</div>
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
		                    	<option value="" {{ old('classroomId') }}></option>
		                        @foreach(App\Classroom::all() as $classroom)
		                        <option value="{{$classroom->id}}" {{ old('classroomId') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
		                        @endforeach
		                    </select>
		                    <div class="invalid-feedback">{{ $errors->first('classroomId') }}</div>
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

		{{-- Botón de nuevo grupo --}}
		@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
			<div class="btn-group" role="group" aria-label="First group">
				<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newGroupModal" onclick="ajustaFechas()">Nuevo</button>
			</div>
		@endif

		<!-- Formulario para buscar -->
		<form class="form col-auto mr-0 ml-auto form-inline" action="{{ route('groups') }}" method="get">

			{{-- Orden --}}
            <select class="form-control mr-3 ml-auto" name="order" onchange="this.form.submit()">
                <option value="1">Ordenar por ID</option>
                <option value="2" {{ app('request')->input('order') == 2 ? 'selected' : '' }}>Ordenar por estado</option>
                <option value="3" {{ app('request')->input('order') == 3 ? 'selected' : '' }}>Ordenar por nombre</option>
                <option value="4" {{ app('request')->input('order') == 4 ? 'selected' : '' }}>Ordenar por nivel</option>
                <option value="5" {{ app('request')->input('order') == 5 ? 'selected' : '' }}>Ordenar por año</option>
                <option value="6" {{ app('request')->input('order') == 6 ? 'selected' : '' }}>Ordenar por periodo</option>
            </select>

			{{-- Filtros --}}
            <select class="form-control mr-3 ml-auto" name="filter" onchange="this.form.submit()">
                <option value="1" >Todos los grupos</option>
                <option value="2" {{ app('request')->input('filter') == 2 ? 'selected' : '' }}>Grupos activos</option>
                <option value="3"  {{ app('request')->input('filter') == 3 ? 'selected' : '' }}>Grupos inactivos</option>
                <option value="4"  {{ app('request')->input('filter') == 4 ? 'selected' : '' }}>Grupos sin profesor</option>
                <option value="5"  {{ app('request')->input('filter') == 5 ? 'selected' : '' }}>Grupos con cupo disponible</option>
                <option value="6"  {{ app('request')->input('filter') == 6 ? 'selected' : '' }}>Grupos llenos</option>
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

@section('scripts')
	<script type="text/javascript">
		function ajustaFechas() {
            var periodo = createGroupForm.periodControlInput;
            var currentdate = new Date();
            var mes = currentdate.getMonth()+1;
            if(mes >= 1 && mes <=6){         //de enero a junio
                periodo.value = 1;           //ene-jun

			}else if(mes == 7){              //solo julio
                periodo.value = 2;           //verano
                
			}else if(mes >= 8 && mes <= 12){ //de agosto a diciembre 
                periodo.value = 3;           //ago-dic
			}
			else if(mes == 12){              //solo diciembre
                periodo.value = 4;           //invierno
			}
			
        }
	</script>

	@if($errors->any())
		<script type="text/javascript">
            var $errorMessage = '';
			@foreach($errors->createUser->all() as $error)
                $errorMessage = $errorMessage + ' {{ $error }}';
			@endforeach
            //alert($errorMessage);
            //Abrir modal de crear nuevo usuario
            $( document ).ready(function() {
                $('#newGroupModal').modal('show');
            });
		</script>
	@endif
@endsection