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
	                    <select class="form-control" id="aplicadorId" name="aplicadorId">
	                    	<option value="" {{ old('aplicadorId') == 0 ? 'selected' : '' }}></option>
	                        @foreach($professors as $professor)
	                        <option value="{{$professor->id}}" {{ old('aplicadorId') == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
	                        @endforeach
	                    </select>
	                   <div class="invalid-feedback">{{ $errors->first('aplicadorId') }}</div>
               		</div>

               		<div class="form-group col">
	                    <label for="professorControlInput">Responsable</label>
	                    <select class="form-control" id="responsableId" name="responsableId">
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
							 <div class="invalid-feedback">{{ $errors->first('capacity') }}</div>						
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


	<!--Botones para manipular tabla y buscador-->
	<div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">

		{{-- Botón de nuevo grupo --}}
		@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
			<div class="btn-group" role="group" aria-label="First group">
				<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newGroupModal" onclick="ajustaFechas()">Nuevo</button>
			</div>
		@endif

		<!-- Formulario para buscar -->
		<form class="form col-auto mr-0 ml-auto form-inline" action="{{ route('toefl') }}" method="get">

             <h5 class="mr-3">{{$count}}/{{$total}} Grupos TOEFL</h5>

			{{-- Orden --}}
            <select class="form-control mr-3 ml-auto" name="order" onchange="this.form.submit()">
                <option value="1">Ordenar por ID</option>
                <option value="2" {{ app('request')->input('order') == 2 ? 'selected' : '' }}>Ordenar por estado</option>
                <option value="3" {{ app('request')->input('order') == 3 ? 'selected' : '' }}>Ordenar por año</option>

            </select>

			{{-- Filtros --}}
            <select class="form-control mr-3 ml-auto" name="filter" onchange="this.form.submit()">
                <option value="1" >Todos los grupos</option>
                <option value="2" {{ app('request')->input('filter') == 2 ? 'selected' : '' }}>Grupos abiertos</option>
                <option value="3"  {{ app('request')->input('filter') == 3 ? 'selected' : '' }}>Grupos cerrados</option>
                <option value="4"  {{ app('request')->input('filter') == 4 ? 'selected' : '' }}>Grupos con cupo disponible</option>
                <option value="5"  {{ app('request')->input('filter') == 5 ? 'selected' : '' }}>Grupos llenos</option>


            </select>

			{{-- Buscador --}}
			<div class="input-group ">
				<input type="text" class="form-control w-auto" placeholder="Escriba el ID de un grupo..." value="{{ app('request')->input('keyword') }}" aria-describedby="btnGroupAddon" name="keyword">
				<div class="input-group-append">
					<button type="submit" class="btn btn-outline-secondary" type="button">Buscar</button>
				</div>
			</div>
		</form>
	</div>

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