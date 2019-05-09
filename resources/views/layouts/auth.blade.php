
<!doctype html>
<html lang="en" class="h-100 w-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>
      @yield('title', config('app.name', 'ERROR'))
    </title>
 
    @include('parts.styles')

  </head>

  <body class="row h-100 w-100 bg-dark">

    <div class="col align-self-center">

      <h4 class="text-center my-5 text-light mx-auto" style="width: 300px;">Sistema de Administración Escolar</h4>

      <div class="card m-auto" style="width: 60em;">
        <div class="card-header">
          @yield('title')
        </div>
        <div class="card-body">

          @yield('content', 'Lo sentimos, tu cuenta se encuentra inactiva en el sistema. En caso de dudas, comunícate con el personal de Vinculación')

        </div>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            
            {{-- Boton para cerrar sesión --}}
            <a class="text-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
      </div>
    </div>

    @include('parts.scripts')

  </body>

  @yield('scripts')

</html>