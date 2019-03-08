<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sintesis</title>
    <!--<title>{{ config('app.name', 'Sintesis') }}</title>-->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                          <!--  <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Sintesis') }}
                            </a>-->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Sintesis - Finanzas
                    </a>
                   
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @guest
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contratos <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li><a href="{{ route('listContract') }}">Listado de Contratos</a></li>
                              <li><a href="{{ route('createContract') }}">Crear Contrato</a></li>
                              <li class="divider"></li>
                              <li><a href="{{ route('listService') }}">Listado de Servicos</a></li>
                              <li><a href="{{ route('createService') }}">Crear Servicio</a></li>
                              <li class="divider"></li>
                              <li><a href="{{ route('listEntity') }}">Listado de Entidades</a></li>
                              <li><a href="{{ route('createEntity') }}">Crear Entidades</a></li>
                              <li class="divider"></li>
                              <li><a href="{{ route('listContact') }}">Listado de Contactos</a></li>
                              <li><a href="{{ route('createContact') }}">Crear Contacto</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestión Operativa<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li><a href="{{ route('createdManagement') }}">Gestionar contratos</a></li>
                              <li class="divider"></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li><a href="{{ route('listCommissions') }}">Comisiones de clientes-Servicios</a></li>
                              <li class="divider"></li>
                            </ul>
                        </li>
  
                        @endguest
                    </ul>

                     <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                            <!--<li><a href="{{ route('register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
