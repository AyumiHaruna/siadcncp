@EXTENDS('main.layouts.master')

@SECTION('title')
  LogIn
@STOP


@SECTION('moreStyles')
  <link rel="stylesheet" href="{{asset('../css/main/login.css')}}">
@STOP


@SECTION('content')
  <div class="container-fluid">

    <!--  /////////////////////////// DIV AVISO ////////////////////////////////// -->
    <div class="row">
        <div class="col-md-4 offset-md-4 aviso text-center"></div>
    </div>


    <video id="bgvid" class="videoFondo" playsinline autoplay muted loop>
      <source src="{{asset('../vid/introInah.mp4')}}" type="video/mp4">
    </video>

    <div class="row">
      <div class="col-md-4 offset-md-4 divLogin">
        <div class="row">
          <div class="col-6 subDivLogin text-center">
            <img src="{{asset('../img/main/logoCultura.png')}}" class="logoCultura">
          </div>
          <div class="col-6 subDivLogin text-center">
            <img src="{{asset('../img/main/logoInah.png')}}" class="logoInah">
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 text-center divSubTitulo">
            INTRANET DE LA COORDINACIÓN NACIONAL DE CONSERVACIÓN DEL PATRIMONIO CULTURAL
          </div>
        </div>

        {!! Form::open(['url' => '/loadLogin', 'id' => 'formLogin']) !!}

        <div class="row">
          <div class="col-md-12 divForms">
            <label for="validationTooltipUsername">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1" linked="usuario"> <i class="fa fa-user" aria-hidden="true"></i> </span>
              </div>
              <input type="text" name="usuario" id="usuario" class="form-control loginInput" placeholder="USUARIO" aria-describedby="basic-addon1"><br>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1" linked="contraseña"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
              <input type="password" name="contraseña" id="contraseña" class="form-control loginInput" placeholder="CONTRASEÑA" aria-describedby="basic-addon1"><br>
            </div>
            <br><br>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1" linked="anio"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
              <select type="text" name="anio" id="anio" class="form-control loginInput" placeholder="Año" aria-describedby="basic-addon1">
                <option value=""> --Seleccione un año-- </option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6 text-left subMenu">
              <!--<span class="spanBtn"> Olvidaste tu Contraseña  <i class="fa fa-question" aria-hidden="true"></i> </span>-->
            </div>
            <!--<div class="col-xs-6 text-right subMenu">
              <span class="spanBtn"> Registrate Aquí!  <i class="fa fa-user-plus" aria-hidden="true"></i></span>
            </div>-->
          </div>
          <button type="button" class="btn btn-lg btn-block btnLogin" id="btnLogin" name="btnLogin">Log In</button>
        </div>

        {!! Form::close() !!}

      </div>
    </div>


  </div>
@STOP

@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //---------------------------------------------------
      //              CONDICIONES INICIALES
      getAñosActivos();
      $(".aviso").hide();

      @IF($errors->any())
        muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; {{$errors->first()}}');
      @ENDIF

      //---------------------------------------------------
      //                ACCIONES DEL DOM
      //--  Enfoca el form seleccionado --
      $(".input-group-addon").click(function(){
         $("#"+$(this).attr("linked")).focus();
      })

      //--  prueba los campos de login y envia
      $("#btnLogin").click(function(){
        testFormLogin();
      });

      //---------------------------------------------------
      //                FUNCIONES GENERALES
      function muestraAviso(tipo, mensaje)
      {
        if(tipo == 'success'){ $(".aviso").addClass('success') }
        $(".aviso").html(mensaje);
        $(".aviso").show();
        setTimeout( function(){
          $(".aviso").hide();
          $(".aviso").removeClass('success');
          //$(".fondoTransparencia").hide();
        } ,2500);
      }

      function testFormLogin(){
        var usuario = $("#usuario").val();
        var contraseña = $("#contraseña").val();
        var anio = $("#anio").val();

        if( usuario != "" ){
          if( contraseña != "" ){
            if( anio != "" ){
               $( "#formLogin" ).submit();
            } else {
              muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta el "AÑO"');
              $("#anio").focus();
            }
          } else {
            muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta la "CONTRASEÑA"');
            $("#contraseña").focus();
          }
        } else {
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta el "USUARIO"');
          $("#usuario").focus();
        }
      }

      //---------------------------------------------------
      //                  FUNCIONES AJAX
      //--  Obtiene los años activos en el sistema
      function getAñosActivos()
      {
        $.ajax({
            data: { "_token": "{{ csrf_token() }}"},
            type: "POST",
            url: "{{ url('../api/aniosActivos') }}"
        })
        .done(function(data){
          data = $.parseJSON(data);
          for( var x=0; x<Object.keys(data).length; x++){
            $("#anio").append('<option value="'+data[x]['anio']+'">Año '+data[x]['anio']+'</option>');
          }
          console.log('getAñosActivos Ok...');
        })
        .fail(function(){
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
        });
      }

    });
  </script>
@STOP
