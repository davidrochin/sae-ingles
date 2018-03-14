
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

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>

  <body class="row h-100 w-100 bg-dark">

    <div class="col align-self-center">

      <h4 class="text-center my-5 text-light mx-auto" style="width: 300px;">Sistema de Administración Escolar</h4>

      <div class="card m-auto" style="width: 500px;">
        <div class="card-header">
          @yield('title')
        </div>
        <div class="card-body">

          @yield('content', 'Error de plantilla.')

        </div>
      </div>
    </div>

  </body>

  @yield('scripts')

</html>