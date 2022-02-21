@EXTENDS('almacen.layouts.masterAlmacenForms')

@SECTION('title')
  Almacen - FormatoSalida
@STOP


@SECTION('moreStyles')
  <link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/almacen/formSalida.css')}}">
  <script src="{{asset('../js/flowtype.js')}}"></script>
@STOP


@SECTION('content')

  <!--  /////////////////////////// DIV TRANSPARENCIA ////////////////////////// -->
  <div class="fondoTransparencia"></div>

  <!--  /////////////////////////// FORM AUTORIZACION ////////////////////////////////// -->
  <div class="col-md-4 offset-md-2 divForm" id="divAutoriza">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url({{asset('../img/almacen/catalogo/phase1.png')}})">
          REQUIERE AUTORIZACIÓN ?
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 text-center">
        <label for="option1"> <i class="far fa-check-circle fa-lg"></i> SI <input type="radio" name="optradio" class="selAutoriza" value="si"> </label>
      </div>
      <div class="col-md-6 text-center">
        <label for="option2"> <i class="far fa-times-circle fa-lg"></i> NO <input type="radio" name="optradio" class="selAutoriza" value="no" CHECKED> </label>
      </div>
      <div class="col-md-12 text-center">
        <label for="firmaEstatica"> ¿Firma VERA TAMAYO JESICA? <input type="checkbox" name="firmaEstatica" class="firmaEstatica"> </label>
      </div>
      <div class="col-md-12 text-center">
        <button type="button" id="btnPrint" class="btn btn-block btnAction btnAcept"><i class="fa fa-print fa-lg" aria-hidden="true"></i> IMPRIMIR</button>
      </div>
    </div>
  </div>

<!--  /////////////////////////// FORM AUTORIZACION ////////////////////////////////// -->
  <div class="col-md-12">
    @FOR($x=1; $x<=$noPags; $x++)
      @FOR($y=1; $y<=2; $y++)
      <div class="row head">
        <div class="col-sm-2 text-center">
          <img src="{{asset('../img/almacen/forms/logoCultura.png')}}" width="150px">
        </div>
        <div class="col-sm-8 text-center">
            COORDINACIÓN NACIONAL DE CONSERVACIÓN DEL PATRIMONIO CULTURAL - INAH <br>
            Almacén - Formato de salida para equipo y material
        </div>
        <div class="col-sm-2 text-center">
          <img src="{{asset('../img/almacen/forms/logoInah.png')}}" width="150px">
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 tableContainer">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Descripción</th>
                <th>No. de Inventario</th>
                <th>Cantidad</th>
                <th>Observaciones</th>
              </tr>
            </thead>
            <tbody>
              @FOR($z=1; $z<=10; $z++)
                <tr class="item{{ $z+(($x-1)*10) }}">
                </tr>
              @ENDFOR
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-8 cuadro">
                <b>(Recibe) Nombre:</b> <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="recibeNombre"> (Nombre) </span>
            </div>
            <div class="col-sm-4 cuadro">
                <b>(Recibe) Firma:</b> <br><br>
            </div>
            <div class="col-sm-8 cuadro divAutoriza">
                <b>(Autoriza) Nombre:</b> <br>
                  &nbsp;&nbsp;&nbsp;<span class="autoriza">  </span> <span class="secAutoriza">VERA TAMAYO JESICA</span>
            </div>
            <div class="col-sm-4 cuadro divAutoriza">
                <b>(Autoriza) Firma:</b> <br><br>
            </div>
            <div class="col-sm-12 cuadro">
                <b>Area</b> <br>
                  &nbsp;&nbsp;&nbsp;<span class="proy"> (Area) </span>
            </div>
          </div>
        </div>
        <div class="col-sm-4 cuadro" style="height:105px;">
          <b>Destino:</b> <br>
          &nbsp;&nbsp;&nbsp;<span class="destino"> (Destino) </span>
        </div>
      </div>

      @IF( $y == 1 )
      <div class="row">
        <div class="col-sm-12" id="hrDiv" style="height: 50px;">
          <hr>
        </div>
      </div>
      @ENDIF
    @ENDFOR
    </div>
  @ENDFOR

@STOP


@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //                CONDICIONES INICIALES
      //---------------------------------------------------
      ajaxGetSalida();
      $(".divAutoriza").hide();
      $(".secAutoriza").hide();

      //                ACCIONES DEL DOM
      //---------------------------------------------------
      $(".selAutoriza").change(function(){
        switch ( $(this).val() ) {
          case 'si':
            $(".divAutoriza").show();
            break;
          case 'no':
            $(".divAutoriza").hide();
            break;
        }
      });

      $("#btnPrint").click(function(){
        $(".divForm, .fondoTransparencia").hide();
        window.print();
      });

      $(".firmaEstatica").click(function(){
        if ($(this).is(':checked')) {
          $(".autoriza").hide();
          $(".secAutoriza").show();
        } else {
          $(".secAutoriza").hide();
          $(".autoriza").show();
        }
      });

      //                FUNCIONES GENERALES
      //---------------------------------------------------


      //                FUNCIONES AJAX
      //---------------------------------------------------
        function ajaxGetSalida(){
          $.ajax({
                data: { "_token": "{{ csrf_token() }}", id:{{$noSalida}}, anio:{{Session('anio')}} },
                type: "POST",
                url: "{{ url('../api/almacen/formatos/getSalidaEsp') }}"
            })
            .done(function(data){
              console.log('ajaxGetSalida(ok)');
              data = $.parseJSON(data);
              console.log(data);
              noPags = {{$noPags}};
              pagAct = 0;

              if(data['obs'] != null){
                if(data['obs'] != ""){
                  var observaciones = data['obs'];
                } else { var observaciones = 'N/A'; }
              } else { var observaciones = 'N/A'; }

              //var observaciones = ((data['obs'] != null || data['obs'] != "") ? data['obs'] : "N/A");
              for(var x=0; x<(noPags * 10); x++){
                ((x % 10 == 0) ? pagAct ++ : "");   //cada 10 iteraciones significan 1 pagina mas
                var thisLista = "";
                if( data['listaSalida'][x] != null ){
                  thisLista = "<td>"+(x+1)+"</td>";
                  thisLista += "<td>"+data['listaSalida'][x]['producto']+"</td>";
                  if( data['listaSalida'][x]['noControl'] == 0 ){
                    thisLista += "<td>N/A</td>";
                  } else { thisLista += "<td>"+data['listaSalida'][x]['noControl']+"</td>"; }
                  thisLista += "<td>"+data['listaSalida'][x]['cantidad']+" "+data['listaSalida'][x]['uMedida']+".</td>";
                } else {
                  thisLista += "<td>&nbsp;</td>";
                  thisLista += "<td>&nbsp;</td>";
                  thisLista += "<td>&nbsp;</td>";
                  thisLista += "<td>&nbsp;</td>";
                }
                ((x == ((pagAct*10)-10)) ? thisLista += "<td rowspan='6' >"+observaciones+"</td>" : "" );
                ((x == ((pagAct*10)-4)) ? thisLista += "<td rowspan='2' ><b>Fecha de Salida:</b> <br> &nbsp;&nbsp;&nbsp;<span class='fechaSalida'> (Fecha Salida) </span></td>" : "");
                ((x == ((pagAct*10)-2)) ? thisLista += "<td rowspan='2' ><b>Fecha Devolución:</b> <br> &nbsp;&nbsp;&nbsp;<span class='fechaDev'> (Fecha Devolución) </span></td>" : "");
                $(".item"+(x+1)).html(thisLista);
              }
              $(".recibeNombre").html(data['nomSol']);
              $(".fechaSalida").html(data['fechaSalida']);
              if(data['fechaDev'] == '0000-00-00'){
                $(".fechaDev").html('N/A');
              } else {
                $(".fechaDev").html(data['fechaDev']);
              }
              $(".autoriza").html(data['datosArea']['encargado']);
              $(".proy").html(data['datosArea']['nombre']);
              /*$(".proy").flowtype({
                minimum   : 150,
                maximum   : 295,
                minFont   : 9,
                maxFont   : 20,
                fontRatio : 30
              });*/
              $(".destino").html(data['destino']);
            })
            .fail(function(){
              console.log('ajaxGetSalida("falló")');
            });
        }
    });
  </script>
@STOP
