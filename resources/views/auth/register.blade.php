@extends('layouts.auth')

@section('title', 'Registar usuario')

@section('content')
<form class="form" method="post" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
        @if ($errors->has('name')) 
        <div class="invalid-feedback">{{ $errors->first('name') }}</div> 
        @endif
    </div>

    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
        @if ($errors->has('email')) 
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password" value="{{ old('password') }}" required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
        @if ($errors->has('password')) 
        <div class="invalid-feedback">{{ $errors->first('password') }}</div> 
        @endif
    </div>

    <div class="form-group">
        <label for="password-confirm">Confirmar contraseña</label>
        <input id="password-confirm" type="password" name="password_confirmation" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Registrar</button>
</form>
@endsection
