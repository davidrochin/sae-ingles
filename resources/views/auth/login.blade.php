        <!doctype html>
        <html lang="en" class="h-100 w-100">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="../../../../favicon.ico">

            <title>
                Iniciar sesión </title>

            @include('parts.styles')
        </head>

        <body class="bg-dark h-100"></body>

            <div class="container d-flex flex-column">

                <!-- Título y subtítulo -->
                <div class="row mt-3">
                    <h2 class="col-12 text-center my-2 text-light mx-auto">Departamento de Gestión Tecnológica y Vinculación</h2>
                    <h3 class="col-12 text-center my-1 text-light mx-auto">Programa CLE-ITLM</h3>
                </div>

                <!-- Cuerpo -->
                <div class="row my-5 justify-content-center">

                    <!-- Panel de inicio de sesión -->
                    <div id="login-panel" class="col-8 col-lg-4 login-form-2 p-4">
                        <h3 class="mb-4">Iniciar Sesión</h3>
                        <form class="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input id="email" type="email" name="email" placeholder="Correo electrónico"
                                    value="{{ old('email') }}" required autofocus
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                @if ($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}
                                </div> @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" name="password" placeholder="Contraseña" required
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                @if ($errors->has('password')) <div class="invalid-feedback">
                                    {{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <!-- Botón para iniciar sesión -->
                            <div class="form-group">
                                <input type="submit" class="btnSubmit" value="Iniciar Sesión" />
                            </div>

                            <!-- Link para reestablecer la contraseña -->
                            {{-- <div class="form-group">
                                <a href="{{ route('password.request') }}" class="ForgetPwd" value="Login">¿Olvidaste la
                                    contraseña?</a>
                            </div>--}}
                          

                            <!-- Botón para mostrar el formulario de registro -->
                            <div class="form-group">
                                <a href="#" class="ForgetPwd" value="SignUp" onclick="showSignupForm()">Inscribirse</a>
                            </div>
                        </form>
                    </div>

                    <!-- Panel de registro -->
                    <div id="signin-panel" class="col-12 col-lg-6 login-form-1 p-4 d-none">
                      
                        <h3>Registro para alumnos</h3>
                        <p><strong>Datos personales</strong></p>
                         <form class="form" action="/alumnos/solicitar-registro" method="post" id="createStudentForm">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <input type="text" name="firstNames" id="email" class="form-control input-sm" placeholder="Nombre">
                            </div>

                            <div class="row">

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="lastNames1" id="last_name1" class="form-control input-sm"
                                            placeholder="Apellido paterno">
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="lastNames2" id="last_name2 class="form-control input-sm"
                                            placeholder="Apellido materno">
                                    </div>
                                </div>

                            </div> <!-- FIN DEL DIV ROW -->

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-sm"
                                    placeholder="Correo electrónico">
                            </div>

                            <div class="row"> <!-- CONTENEDOR DE PASSWORDS -->

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control input-sm"
                                            placeholder="Contraseña">
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control input-sm" placeholder="Confirmar contraseña">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <input type="number" name="phoneNumber" min="0" class="form-control input-sm" placeholder="Teléfono"
                                    pattern="[0-9]">
                            </div>

                            <div class="form-group">
                                <p><strong>Selecciona la opción de acuerdo sí eres estudiante del ITLM</strong></p>


                                
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="origen" onclick="show1();"
                                        value="ext">
                                    <span class="form-check-label">Externo</span>
                                </label>

                                
                                    <label class="form-check form-check-inline ">
                                        <input  class="form-check-input" type="radio"
                                            name="origen" value="int" onclick="show2();">
                                        <span class="form-check-label">Interno</span>
                                    </label>
                            </div> <!-- FIN DIV DE CONTENEDOR DE RADIOBUTTONS -->


                       <div id="div1" class="hide">                                
                                <div class="form-group ">
                                        <p><strong>LLena los campos con la carrera que cursas y tu No. Control de estudiante.</strong></p>

                                         <input type=" text" name="controlNumber" min="0" maxlength="8"
                                          class="form-control input-sm" placeholder="No. Control" >
                                </div>
                                          {{-- Selector de carrera --}}
                            <div class="form-group">
                               
                                <select class="form-control" id="careerControlInput" name="careerId">
                                    <option value="">Selecciona una carrera</option>
                                    <!-- Llenar el select con las carreras de la base de datos -->
                                    @foreach($careers as $career)
                                    <option value="{{$career->id}}" {{ old('careerId') == $career->id ? 'selected' : '' }}>{{ $career->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                </div>                                   
     <input type="submit" class="btn btn-primary btn-block form-group" value="Guardar" form="createStudentForm">
                      
                        </form>
               
                    </div>
                </div>

                <!-- Pié de página -->
                <div>
                    <h6 class="text-center text-light mx-auto mb-4" style="width: 200px;">Instituto Tecnológico de Los Mochis
                    </h6>
                </div>

            </div>
            </div>


            <script>
            
            function showSignupForm(){
                $("#signin-panel").removeClass("d-none");
                $("#login-panel").addClass("d-none");
            }

            function show1(){
             document.getElementById('div1').style.display ='none';
            }

            function show2(){
             document.getElementById('div1').style.display = 'block';
            }
            
            </script>

            <!-- Icons -->
            <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
            <script>feather.replace()</script>

            <!-- jQuery -->
            <script src="http://localhost:8000/js/jquery-3.3.1.min.js"></script>
            <script src="http://localhost:8000/js/bootstrap.bundle.min.js"></script>
            <script src="http://localhost:8000/js/sae.js"></script>
            <script src="http://localhost:8000/js/bootstrap-confirmation.min.js"></script>
        </body>

        </html>