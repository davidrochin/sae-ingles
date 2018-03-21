@extends('layouts.app')

@section('section', 'Página principal')

@section('content')

@component('components.card')
	<p>Bienvenido(a) <b>{{ Auth::user()->name }}</b>. Puede navegar por las diferentes secciones del sistema usando el menú de la izquierda.</p>

	@component('components.alert')
	@slot('type', 'warning')
	@slot('style', 'mb-0')
	Si usted no está usando <b>Google Chrome</b>, puede que este sistema no funcione correctamente. Para asegurarse de que este sistema funcione como debería, descargue la última versión de Google Chrome haciendo clic <a href="https://www.google.com.mx/chrome/" target="_blank">aquí</a>.
	@endcomponent
@endcomponent

@endsection
