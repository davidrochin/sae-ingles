@extends('layouts.app')
@section('title', 'Usuarios del sistema')
@section('section', 'Usuarios del sistema')

@section('content')

	<!--Modal-->
	@component('components.modal')
		@slot('id', 'newUserModal')
		@slot('title', 'Nuevo usuario')
		@slot('dismiss', 'Cancelar')

		@slot('body')

			<!-- Formulario de nuevo grupo -->
			<form action="/usuarios/crear" class="form"  method="post" id="registerUserForm" autocomplete="off">

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
	                        @slot('type','email')
						@endcomponent
					</div>
				</div>
				<div class="form-row">
					<div class="col">
	                    @component('components.form-input')
	                        @slot('tag', 'Contraseña')
	                        @slot('name', 'password')
	                        @slot('type','password')
	                    @endcomponent
					</div>
				</div>

	            <script type="text/javascript">
	                document.getElementById('passwordControlInput').setAttribute("autocomplete","new-password");
	                document.getElementById('nameControlInput').setAttribute("autocomplete","nope");
	                document.getElementById('emailControlInput').setAttribute("autocomplete","nope");
	            </script>

			</form>

		@endslot

		@slot('footer')
			<input type="submit" class="btn btn-primary" value="Crear" form="registerUserForm">
		@endslot
	@endcomponent

	<!-- Modal para cambiar contraseña -->
    @component('components.modal')
		@slot('id','newPasswordUserModal')
		@slot('title','Nueva contraseña')
		@slot('dismiss','Cancelar')

		@slot('body')

			<!-- Formulario para cambiar de contraseña -->
			<form action="/usuario/modificarContraseña" class="form" method="post" id="changeUserPasswordForm" autocomplete="new-password">

                {{ csrf_field() }}

				<div class="form-row">
					<div class="col">
						@component('components.form-input')
							@slot('tag','Contraseña')
							@slot('name','newPassword')
							@slot('type','text')
							@slot('autocomplete,','off')
						@endcomponent
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						<button type="button" class="btn btn-outline-primary" onclick="generarPassword()">Generar</button>
						<button type="button" class="btn btn-outline-primary" onclick="copiarAPortapapeles()">Copiar</button>
					</div>
				</div>

			</form>
		@endslot

		@slot('footer')
			<input type="submit" class="btn btn-primary" value="Cambiar"  form="changeUserPasswordForm">
		@endslot
	@endcomponent


	<!--Botones para manipular tabla y buscador-->
	<div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group" role="group" aria-label="First group">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newUserModal">Nuevo</button>
		</div>
	</div>

	<div>
		@include('tables.users')

		<div class="row">
			<div class="mx-auto">
				{{ $users->appends($_GET)->links('pagination::bootstrap-4') }}
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		function generarPassword() {
            var pwdChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            var pwdLen = 6;
            var randPassword = Array(pwdLen).fill(pwdChars).map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('');
            changeUserPasswordForm.newPasswordControlInput.value = randPassword;
        }
        function copiarAPortapapeles() {
		    var textoCopiado = changeUserPasswordForm.newPasswordControlInput;
		    textoCopiado.select();

            document.execCommand("Copy");
        }
        function agregaDatos() {
            $('#usersTable').find('tr').click( function(){
                var row = $(this).find('td:first').text();
                var id = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "id").val(row);
                $('#changeUserPasswordForm').append($(id));
            });
        }

	</script>
	<!-- Verificar si hubo un error en algun formulario, verificar en cual y reabrirlo -->
	@if($errors->first('newPassword'))
		<script type="text/javascript">
            //Abrir modal de nueva contraseña
            $( document ).ready(function() {
                $('#newPasswordUserModal').modal('show');
            });
		</script>
		@else
			@if($errors->any())
				<script type="text/javascript">
                    var $errorMessage = '';
					@foreach($errors->createUser->all() as $error)
                        $errorMessage = $errorMessage + ' {{ $error }}';
					@endforeach
                    //alert($errorMessage);
                    //Abrir modal de crear nuevo usuario
                    $( document ).ready(function() {
                        $('#newUserModal').modal('show');
                    });
				</script>
			@endif
	@endif
@endsection
