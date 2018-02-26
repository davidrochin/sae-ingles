@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('content')
<form class="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <!-- Email input -->
    <div class="form-group">
        <label for="email" >Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
        @if ($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
    </div>

    <!-- Password input -->
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password" required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
        @if ($errors->has('password')) <div class="invalid-feedback">{{ $errors->first('password') }}</div> @endif
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        
</form>
@endsection
