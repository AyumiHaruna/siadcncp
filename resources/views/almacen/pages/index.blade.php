@EXTENDS('almacen.layouts.masterAlmacen')

@SECTION('title')
  Almacen - Index
@STOP


@SECTION('moreStyles')
  <link rel="stylesheet" href="{{asset('../css/almacen/index.css')}}">
@STOP


@SECTION('content')

    <div class="col-md-10 offset-md-1 main-div text-center">
      <span id="span-1"> Hola </span> &nbsp; <span id="span-2">{{Session('nombre')}}</span><br>
      <span id="span-3">BIENVENID@ AL SISTEMA DE CONTROL DEL </span> <span id="span-4">"ALMACÉN"</span> <br>
      <img src="{{ asset('../img/almacen/almacenPic.png') }}" id="almPic"><br>
      Datos del año {{ Session('anio') }} Ver.(2.0.1)
    </div>

@STOP


@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //---------------------------------------------------
      //              CONDICIONES INICIALES


      //---------------------------------------------------
      //                ACCIONES DEL DOM


      //---------------------------------------------------
      //                FUNCIONES GENERALES


      //---------------------------------------------------
      //                  FUNCIONES AJAX


    });
  </script>
@STOP
