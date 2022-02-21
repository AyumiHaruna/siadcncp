<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="{{ asset('../img/almacen/logoInahSoloBlack.png') }}"  class="d-inline-block align-top" id="brandLogo">
  <a class="navbar-brand" href="{{ url('/almacen') }}">SICA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('almacen/catalogo*') ? 'active' : '' }}" href="{{ url('/almacen/catalogo') }}">Catálogo <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('almacen/entradas*') ? 'active' : '' }}" href="{{ url('/almacen/entradas') }}">Entradas</a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('almacen/salidas*') ? "active" : "" }}" href="{{ url('/almacen/salidas') }}">Salidas</a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('almacen/reingresos*') ? "active" : "" }}" href="{{ url('/almacen/reingresos') }}">Reingresos</a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('almacen/reportes*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reportes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('/almacen/reportes/existencias') }}">Lista de Existencias {{ Request::is('almacen/reportes/existencias*') ? '*' : '' }}</a>
          <a class="dropdown-item" href="{{ url('/almacen/reportes/repSalidas') }}">Reporte de Salidas {{ Request::is('almacen/reportes/repSalidas*') ? '*' : '' }}</a>
        </div>
      </li>
    </ul>


    <ul class="navbar-nav">
      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sistemas
        </a>
        <<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Sicofi</a>
            <a class="dropdown-item" href="#">Nóminas</a>
            <a class="dropdown-item" href="#">Almacén</a>
        </div>
      </li>-->

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Session('nombre') }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ url('/logOff') }}">Cerrar Sesión</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Año activo({{ Session('anio') }})
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          @FOREACH($aniosA as $a)
            <a class="dropdown-item" href="{{ url('cambiaAnio/almacen/'.$a['anio']) }}">{{ $a['anio'] }}</a>
          @ENDFOREACH
        </div>
      </li>
    </ul>
  </div>
</nav>
