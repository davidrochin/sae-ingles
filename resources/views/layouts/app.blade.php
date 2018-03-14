
<!doctype html>
<html lang="en">
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

    <!-- Hola de estilos propia para hacer ajustes -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-adjustments.css') }}" />
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">

      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('home') }}">{{ config('app.name', 'ERROR') }}</a>
      <div class="form-control form-control-dark text-light text-center w-100">Autenticado como {{ Auth::user()->name }} - {{ Auth::user()->role->description }}</div>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">

        <!--Barra de navegación lateral-->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">

            @if(Auth::user()->hasAnyRole(['admin', 'coordinator'])) {{-- Sección solo para administradores y coordinadores --}}

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Coordinación</span>
            </h6>

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ isset($parentRoute) && $parentRoute == 'students' ? 'active' : '' }}" href="{{ route('students') }}">
                  <span data-feather="users"></span>
                  Alumnos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ isset($parentRoute) && $parentRoute == 'groups' ? 'active' : '' }}" href="{{ route('groups') }}">
                  <span data-feather="calendar"></span>
                  Grupos
                </a>
              </li>
            </ul>

            @endif

            @if(Auth::user()->hasRole('professor')) {{-- Sección solo para profesores --}}

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Calificaciones</span>
            </h6>

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span data-feather="users"></span>
                  Administrar calificaciones
                </a>
              </li>
            </ul>

            @endif

            @if(Auth::user()->hasRole('admin')) {{-- Sección solo para administradores --}}

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Sistema</span>
            </h6>

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ isset($parentRoute) && $parentRoute == 'users' ? 'active' : '' }}" href="{{ route('users') }}">
                  <span data-feather="users"></span>
                  Usuarios
                </a>
              </li>
            </ul>

            @endif

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
              @yield('section', 'Sección desconocida')
            </h1>
            <!--<div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                Semanal
              </button>
            </div>-->
          </div>

          <!-- Alerta de éxito. Solo se muestra si es necesario -->
          @include('components.success-alert')

          @yield('content', 'No hay contenido que mostrar...')

        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <!--<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>-->

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Bootstrap script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>

  @yield('scripts')

</html>