@extends('layouts.auth')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<form class="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
  <!--aqui adentro va un formulario--->
</form>



<div class="container login-container">
          <h4 class="text-center my-5 text-light mx-auto" style="width: 300px;">Sistema de Administración Escolar</h4>
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Administradores</h3>
                    
                        <div class="form-group">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Correo electrónico">
                            @if ($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" name="password" required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Contraseña">
                            @if ($errors->has('password')) <div class="invalid-feedback">{{ $errors->first('password') }}</div> @endif
                        </div>
                        <div class="form-group">
                              <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        </div>
                    
                </div>
                <div class="col-md-6 login-form-2">
                    <div class="login-logo">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                    </div>
                    <h3>Alumnos</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">

                            <a href="#" class="btnForgetPwd" value="Login">Forget Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


