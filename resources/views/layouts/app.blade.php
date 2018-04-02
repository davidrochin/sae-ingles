<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">

    @include('parts.styles')

    <title>{{ config('app.name', 'NOT SET') }}</title>
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

        <!-- Barra lateral -->
        <div class="col-md-12 col-xl-2 p-0 sidebar">
          <span class="d-block p-3 bg-dark text-white text-center">S.A.E.</span>    
          <div class="p-0" style="">
              <span class="sidebar-section text-muted">General</span>
              <a href="{{ route('home') }}" class="{{ $parentRoute == 'home' ? 'selected' : '' }}"><i data-feather="home"></i>Inicio</a>
              <hr>

              <span class="sidebar-section text-muted">Coordinación</span>
              <a href="{{ route('students') }}" class="{{ $parentRoute == 'students' ? 'selected' : '' }}"><i data-feather="users"></i>Alumnos</a>
              <a href="{{ route('groups') }}" class="{{ $parentRoute == 'groups' ? 'selected' : '' }}"><i data-feather="calendar"></i>Grupos</a>
              <hr>

              <span class="sidebar-section text-muted">Sistema</span>
              <a href="{{ route('users') }}" class="{{ $parentRoute == 'users' ? 'selected' : '' }}"><i data-feather="users"></i>Usuarios</a>
              <hr>

              <span class="sidebar-section text-muted">Para profesores</span>
              <a href="{{ route('grades') }}" class="{{ $parentRoute == 'grades' ? 'selected' : '' }}"><i data-feather="calendar"></i>Mis grupos</a>
              <hr>

              <span class="sidebar-section text-muted">Sistema</span>
              <a href="{{ route('about') }}" class="{{ $parentRoute == 'about' ? 'selected' : '' }}"><i data-feather="tag"></i>Acerca de</a>
          </div>
        </div>

        <!-- Columna que ocupa el espacio de la barra -->
        <div class="d-none d-xl-block col-xl-2 p-0" style="height: 100px;">
          
        </div>

        <!-- Barra de arriba y contenido -->
        <div class="col-xl-10">
          <div class="row p-0">
            <div class="col p-3 text-white text-center" style="background-color: rgba(0, 0, 0, 0.65);">Autenticado como {{ Auth::user()->name }} - {{ Auth::user()->role->description }}</div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            <a class="col-auto p-3 bg-dark text-center text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
          </div>
          
          <div class="content py-4 px-2">
            <h1 class="h2">
              @yield('title', 'Título indefinido')
            </h1><hr>

            @yield('content', 'No hay contenido para mostrar.')
          </div>

        </div>
      </div>
    </div>

    @include('parts.scripts')

  </body>

  @yield('scripts')

  <!-- Para hacer la barra Fixed en pantallas grandes -->
  <script type="text/javascript">

    function setSidebarPos(){
      var dummy = document.querySelector('.sidebar');
      //console.log(window.innerWidth);
      if(window.innerWidth >= 1200){
        dummy.style.position = 'fixed';
      } else {
        dummy.style.position = 'relative';
      }
    }

    $(window).resize(function() { setSidebarPos(); });
    $(document).ready(function() { setSidebarPos(); });

  </script>

  <!-- Abrir el modal que muestra mensajes del sistema si es necesario -->
  @if(session('message'))
  <script type="text/javascript">
    $( document ).ready(function() {
          $('#defaultModal').modal('show');
      });
  </script>
  @endif

</html>