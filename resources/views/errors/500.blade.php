@extends('layouts.auth')

@section('title', 'Error interno')

@section('content')

<p>Ha habido un error interno en el sistema. No se ha podido hacer lo que ha solicitado. Si usted estaba usando correctamente el sistema cuando ocurrió esto, por favor contacte a un administrador.</p>
<button class="btn btn-primary float-right" onclick="window.history.back();">Volver atrás</button>

@endsection