
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

      <h6 class="text-center my-5 text-light mx-auto" style="width: 300px;">Instituto Tecnológico de Los Mochis</h6>

    </div>

    @include('parts.scripts')

  </body>

  @yield('scripts')

</html>