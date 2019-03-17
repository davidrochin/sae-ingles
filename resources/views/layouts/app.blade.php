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

          {{-- Botón para abrir el menú --}} 
          {{--<div class="d-block d-xl-none p-3 bg-gray text-center" onclick="toggleMenu();">Abrir menú</div>--}}

          <div class="p-0 d-none d-xl-block" style="" id="menu">
              <span class="sidebar-section text-muted">General</span>
              <a href="{{ route('home') }}" class="{{ $parentRoute == 'home' ? 'selected' : '' }}"><i data-feather="home"></i>Inicio</a>
              <a href="{{ route('my-groups') }}" class="{{ $parentRoute == 'my-groups' ? 'selected' : '' }}"><i data-feather="grid"></i>Mis grupos</a>
              <hr>

              <span class="sidebar-section text-muted">Coordinación</span>
              <a href="{{ route('solicitudes') }}" class="{{ $parentRoute == 'solicitudes' ? 'selected' : '' }}"><i data-feather="bookmark"></i>Solicitudes</a>
              <a href="{{ route('students') }}" class="{{ $parentRoute == 'students' ? 'selected' : '' }}"><i data-feather="users"></i>Alumnos</a>
              <a href="{{ route('groups') }}" class="{{ $parentRoute == 'groups' ? 'selected' : '' }}"><i data-feather="calendar"></i>Grupos</a>
              <a href="{{ route('groups') }}" class="{{ $parentRoute == 'toefl-groups' ? 'selected' : '' }}"><i data-feather="file-text"></i>TOEFL</a>
              <hr>

              <span class="sidebar-section text-muted">Sistema</span>
              <a href="{{ route('users') }}" class="{{ $parentRoute == 'users' ? 'selected' : '' }}"><i data-feather="users"></i>Usuarios</a>
              <a href="{{ route('users') }}" class="{{ $parentRoute == 'settings' ? 'selected' : '' }}"><i data-feather="settings"></i>Configuración</a>
              <a href="{{ route('about') }}" class="{{ $parentRoute == 'history' ? 'selected' : '' }}"><i data-feather="book"></i>Historial</a>
              <a href="{{ route('about') }}" class="{{ $parentRoute == 'about' ? 'selected' : '' }}"><i data-feather="tag"></i>Acerca de</a>
              <hr>
              
          </div>
        </div>

        <!-- Columna que ocupa el espacio de la barra -->
        <div class="d-none d-xl-block col-xl-2 p-0" style="height: 100px;">
        </div>

        <!-- Barra de arriba y contenido -->
        <div class="col-xl-10">
          <div class="row p-0">

            {{-- Botón para abrir el menú --}} 
            <a id="toggleMenuButton" class="col-auto d-block d-xl-none p-3 bg-primary text-white text-center" href="#" onclick="toggleMenu();event.preventDefault(); ">Abrir menú</a> 

            <div class="col p-3 text-white text-center" style="background-color: rgba(0, 0, 0, 0.65);">Autenticado como {{ Auth::user()->name }} - {{ Auth::user()->role->description }}</div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            
            {{-- Boton para cerrar sesión --}}
            <a class="col-auto p-3 bg-dark text-center text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
          </div>
          
          {{-- Mostrar alerta de éxito de ser necesario --}}
          @if(session('success'))
            @component('components.alert')
              @slot('class', 'mb-0 mt-3')
              @slot('type', 'success')
              {{ session('success') }}
            @endcomponent
          @endif

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

    function toggleMenu(){
      if($('#menu').hasClass('d-none')) {
        $('#menu').removeClass('d-none');
        $('#toggleMenuButton').remove();
      } else {
        $('#menu').addClass('d-none');
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

  <!-- Activar confirmaciones -->
  <script type="text/javascript">
    $('[data-toggle=confirmation]').confirmation({
      rootSelector: '[data-toggle=confirmation]',
      // other options
    });
  </script>

</html>