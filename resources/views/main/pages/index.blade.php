@EXTENDS('main.layouts.masterIndex')

@SECTION('title')
  Index
@STOP


@SECTION('moreStyles')
  <link rel="stylesheet" href="{{asset('../css/main/index.css')}}">
@STOP


@SECTION('content')
  <div class="col-md-12 mainDiv">
    <div class="row justify-content-md-center">
      <!--<div class="col-md-3 text-center imgContainer">
        <img src="{{asset('../img/main/semiBG/bgSicofi.jpg')}}" alt="SICOFI" class="rounded-circle btnBg">
        <div class=" imgContainer-2">
          <a href="{{ url('http://172.26.26.126/sicofi') }}"><img src="{{asset('../img/main/semiBG/circle.png')}}" class="rounded-circle btnBg2" id="1"></a>
        </div>
        <div class="col-md-12 text-center msgContainer" id="msgSicofi">
          SICOFI
        </div>
      </div>

      <div class="col-md-3 text-center imgContainer">
        <img src="{{asset('../img/main/semiBG/bgNomina.jpg')}}" alt="NÓMINAS" class="rounded-circle btnBg">
        <div class=" imgContainer-2">
          <a href="{{ url('http://172.26.26.126/nomina') }}"><img src="{{asset('../img/main/semiBG/circle.png')}}" class="rounded-circle btnBg2" id="2"></a>
        </div>
        <div class="col-md-12 text-center msgContainer" id="msgNominas">
          NÓMINAS
        </div>
      </div>-->

      <div class="col-md-3 text-center imgContainer">
        <img src="{{asset('../img/main/semiBG/bgAlmacen.jpg')}}" alt="ALMACÉN" class="rounded-circle btnBg">
        <div class=" imgContainer-2">
          <a href="{{ url('/almacen') }}"><img src="{{asset('../img/main/semiBG/circle.png')}}" class="rounded-circle btnBg2" id="3">
        </div>
        <div class="col-md-12 text-center msgContainer" id="msgAlmacen">
          ALMACÉN
        </div>
      </div>
    </div>
  </div>

@STOP

@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //---------------------------------------------------
      //              VARIABLES GLOBALES


      //---------------------------------------------------
      //              CONDICIONES INICIALES

      //$(".transbg").hide()

      //---------------------------------------------------
      //                ACCIONES DEL DOM
      $(".btnBg2").hover(function(){
         $(this).addClass('spin');
         switch ($(this).attr('id')) {
           case "1":
             $('#msgSicofi').addClass('moving');
           break;
           case "2":
              $('#msgNominas').addClass('moving');
           break;
           case "3":
              $('#msgAlmacen').addClass('moving');
           break;
         }
         console.log( $(this).attr('id') );
       }, function() {
         $(this).removeClass('spin');
         switch ($(this).attr('id')) {
           case "1":
             $('#msgSicofi').removeClass('moving');
           break;
           case "2":
              $('#msgNominas').removeClass('moving');
           break;
           case "3":
              $('#msgAlmacen').removeClass('moving');
           break;
         }
      });

      //---------------------------------------------------
      //                FUNCIONES GENERALES
      //cambia constantemente el background


      //---------------------------------------------------
      //                  FUNCIONES AJAX
      //--  Obtiene los años activos en el sistema

    });
  </script>
@STOP
