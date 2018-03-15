@extends('layouts.app')
@section('title', 'Usuarios del sistema')
@section('section', 'Usuarios del sistema')

@section('content')

<div class="">

	<!--Modal-->
	@component('components.modal')
		@slot('id', 'newUserModal')
		@slot('title', 'Nuevo usuario')
		@slot('dismiss', 'Cancelar')

		@slot('body')

			<!-- Formulario de nuevo grupo -->
			<form class="form" action="/usuarios/crear" method="post" id="createUserForm">

				{{ csrf_field() }}

				<div class="form-row">
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Nombre')
							@slot('name', 'name')
						@endcomponent
					</div>	
				</div>				
				<div class="form-group">
					<label for="roleId">Carrera</label>
                        <select name="roleId" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->description }}</option>
                            @endforeach
                        </select>
				</div>
				<div class="form-row">
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Correo electrónico')
							@slot('name', 'email')
						@endcomponent
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						@component('components.form-input')
							@slot('tag', 'Contraseña')
							@slot('name', 'password')
							@slot('type', 'password')
						@endcomponent
					</div>
				</div>

			</form>
		@endslot

		@slot('footer')
			<input type="submit" class="btn btn-primary" value="Crear" form="createUserForm">
		@endslot
	@endcomponent

	<!--Botones para manipular tabla y buscador-->
	<div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group" role="group" aria-label="First group">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newUserModal">Nuevo</button>
		</div>
	</div>

</div>

<div class="">
	
	
</div>

	@include('tables.users')
<div class="row">
    <div class="mx-auto">
        {{ $users->appends($_GET)->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection