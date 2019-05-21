@extends('layouts.auth')

@section('title', 'Acerca de')

@section('content')

<p class="text-center">Desarrollado por</p>

<div class="row">
	<div class="col">
		<img src="https://avatars.githubusercontent.com/oswaldoguevara" class="rounded-circle img-fluid p-4">
		<p class="text-center">Oswaldo Guevara Sánchez<br><a href="https://github.com/oswaldoguevara">github.com/oswaldoguevara</a></p>
	</div>

	<div class="col">
		<img src="https://avatars.githubusercontent.com/davidrochin" class="rounded-circle img-fluid p-4">
		<p class="text-center">José David Rochín Cerecer<br><a href="https://github.com/davidrochin">github/davidrochin</a></p>
	</div>	

	<div class="col">
		<img src="https://avatars.githubusercontent.com/christianLugo5" class="rounded-circle img-fluid p-4">
		<p class="text-center">Christian Ricardo Lugo Arellano<br><a href="https://github.com/christianLugo5">github/christianLugo5</a></p>
	</div>	

	
</div>

<hr>

<p class="text-center">Hecho con Laravel 5.5, Bootstrap 4 y jQuery.</p>
{{-- Botón de nuevo grupo --}}
		@if(Auth::user()->hasAnyRole(['admin', 'coordinator','professor']))
	<p class="text-center"><a href="https://drive.google.com/open?id=1H-3FvXtS7ue-thnbgnaK11OwnPw4dASk" target="_blank">Manual de usuario</a></p>		
		@endif



<div class="text-center">
	<button class="btn btn-primary" onclick="window.history.back();">Volver</button>
</div>

@endsection