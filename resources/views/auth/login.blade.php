    @extends('layouts.blanco')
    @section('title', 'Iniciar sesión')

    @section('content')

      
    <div class="container login-container">



                <div class="row">
                    <div class="col-md-6 login-form-1">
                        <h3>Administradores</h3>
                        <form class="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
                            <div class="form-group">
                                <input id="email" type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                 @if ($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" name="password" placeholder="Contraseña" required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            @if ($errors->has('password')) <div class="invalid-feedback">{{ $errors->first('password') }}</div> @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btnSubmit" value="Iniciar Sesión" />
                            </div>
                            <div class="form-group">
                                <a href="{{ route('password.request') }}" class="ForgetPwd">¿Olvidaste la contraseña?</a>
                            </div>
                        </form>
                    </div>


                    <div class="col-md-6 login-form-2">
                        <h3>Alumnos</h3>
                        <form class="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
                            <div class="form-group">
                                <input id="email" type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
             @if ($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" name="password" placeholder="Contraseña" required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            @if ($errors->has('password')) <div class="invalid-feedback">{{ $errors->first('password') }}</div> @endif
                            </div>
                          <div class="row">
                              
                          </div>
                                <div class="form-group">
                                <input type="submit" class="btnSubmit" value="Iniciar Sesión" />
                            </div>
                            
                           
                            <div class="form-group">

                                <a href="{{ route('password.request') }}" class="ForgetPwd" value="Login">¿Olvidaste la contraseña?</a>
                            </div>
                               <div class="form-group">

                                <a href="{{ route('password.request') }}" class="Registrarse" value="Login">Registrarse</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
    @endsection
