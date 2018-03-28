<!DOCTYPE html>
<html lang="en" class="bg-{{ $background or '' }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" crossorigin="anonymous">
    <!--<link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-adjustments.css') }}" />

    <title>
      @yield('title', config('app.name', 'NOT SET'))
    </title>
  </head>

  <body>

    <!-- Modal default. -->
    @component('components.modal')
      @slot('id', 'defaultModal')
      @slot('title', 'Mensaje del sistema')
      @slot('body')
        {{ session('message') }}
      @endslot
    @endcomponent

    <!-- Container principal -->
    <div class="container-fluid">

      <div class="row">
        <a class="col col-xl-2 p-3 bg-dark text-white text-center">P.C.E.</a>
        <div class="col p-3 d-none d-xl-block text-white text-center" style="background-color: rgba(0, 0, 0, 0.65);">Autenticado como {{ Auth::user()->name }} - {{ Auth::user()->role->description }}</div>
        <a class="col-auto p-3 bg-dark text-center text-white" href="#">Cerrar sesión</a>
      </div>

      <div class="row">

        <!-- Barra lateral -->
        <div class="col-xl-2 col-md-12 p-0 sidebar" style="">
            <span class="sidebar-section text-muted">General</span>
            <a href="#" class="selected"><i data-feather="home"></i>Inicio</a>
            <hr>

            <span class="sidebar-section text-muted">Coordinación</span>
            <a href="#"><i data-feather="users"></i>Estudiantes</a>
            <a href="#"><i data-feather="calendar"></i>Grupos</a>
            <hr>

            <span class="sidebar-section text-muted">Sistema</span>
            <a href="#"><i data-feather="users"></i>Usuarios</a>
            <hr>

            <span class="sidebar-section text-muted">Para maestros</span>
            <a href="#"><i data-feather="calendar"></i>Mis grupos</a>
            <hr>

            <span class="sidebar-section text-muted">Sistema</span>
            <a href="#"><i data-feather="tag"></i>Acerca de</a>
        </div>

        <!-- Sección para contenido -->
        <div class="col-sm-10 p-4">

          <h1 class="h2">Titulo de la página</h1><hr>

          @include('tables.students')
        </div>
      </div>
    </div>

    

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>feather.replace()</script>

    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('js/sae.js') }}"></script>

  </body>

  @yield('scripts')

  <!-- Abrir el modal que muestra mensajes del sistema si es necesario -->
  @if(session('message'))
  <script type="text/javascript">
    $( document ).ready(function() {
          $('#defaultModal').modal('show');
      });
  </script>
  @endif

</html>