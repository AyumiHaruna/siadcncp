<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="{{ asset('../img/main/logoInahSoloWhite.png') }}"  class="d-inline-block align-top" id="brandLogo">
  <a class="navbar-brand" href="{{ url('/') }}">SIAD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">    </ul>


    <ul class="navbar-nav">
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
