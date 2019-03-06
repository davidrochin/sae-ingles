
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

  <body class="bg-dark">

    <div class="col align-self-center">

      <h1 class="text-center my-2 text-light mx-auto" >Departamento de Gestión Tecnológica y Vinculación</h1>
      <h3 class="text-center my-1 text-light mx-auto">Programa CLE-ITLM</h3>
      <div>
       
        <div class="card-body">

          @yield('content', 'Error de plantilla.')

        </div>
      </div>
    </div>
  <h6 class="text-center my-5 text-light mx-auto" style="width: 300px;">INSTITUTO TECNOLÓGICO DE LOS MOCHIS</h6>
    @include('parts.scripts')

  </body>

  @yield('scripts')

</html>