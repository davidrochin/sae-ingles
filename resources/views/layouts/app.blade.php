<!DOCTYPE html>
<html lang="en" class="bg-{{ $background or '' }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">
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

            @if(Auth::user()->hasAnyRole(['admin','coordinator'])) {{-- Sección solo para administradores --}}

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

            {{--@if(Auth::user()->hasRole('professor'))--}} {{-- Sección solo para profesores --}}

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Para profesores</span>
            </h6>

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('grades') }}">
                  <span data-feather="users"></span>
                  Mis grupos
                </a>
              </li>
            </ul>

            {{--@endif--}}

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Información</span>
            </h6>

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ isset($parentRoute) && $parentRoute == 'about' ? 'active' : '' }}" href="{{ route('about') }}">
                  <span data-feather="tag"></span>
                  Acerca de
                </a>
              </li>
            </ul>

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-{{ $background or '' }}">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 {{ isset($background) && ($background == 'dark' || $background == 'secondary') ? 'text-white' : '' }}{{ isset($background) && $background == 'gray' ? 'text-secondary' : ''}}">
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