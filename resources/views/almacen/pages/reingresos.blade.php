@EXTENDS('almacen.layouts.masterAlmacen')


@SECTION('title')
  Almacen - Reingresos
@STOP


@SECTION('moreStyles')
  <script src="{{asset('../js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('../js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('../js/readOnly.js')}}"></script>
  <link rel="stylesheet" href="{{asset('../css/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/almacen/reingresos.css')}}">
@STOP


@SECTION('content')
  <!--  /////////////////////////// DIV TRANSPARENCIA ////////////////////////// -->
  <div class="fondoTransparencia"></div>
  <div class="fondoTransparencia2"></div>

  <!--  /////////////////////////// DIV AVISO ////////////////////////////////// -->
  <div class="col-md-4 offset-md-4 aviso text-center"></div>


  <!--  /////////////////////////// MAIN DIV ////////////////////////////////// -->
  <div class="col-md-12 main-div">
    <div class="row">
      <div class="col-md-12 subTitle text-center" style="background-image:url(../img/almacen/reingresos/salidaIcon.png)">
        - REINGRESOS -
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 table-responsive" id="bloLisSalidas">

      </div>
    </div>
  </div>


  <!--  /////////////////////////// DIV FORM ////////////////////////////////// -->
  <div class="col-md-8 offset-md-2 divForm" id="divForReiCon">
    <div class="row">
      <div class="col-md-12 text-center titulo">
          REINGRESAR PRODUCTO
      </div>
    </div>

    <form id="forReiCon">
      <div class="row inForm">
        <div class="col-md-2">
          <label for="noSalida"># Salida:</label>
          <input type="text" id="noSalida" class="form-control">
          <input type="hidden" id="limite">
        </div>
        <div class="col-md-5">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" class="form-control">
        </div>
        <div class="col-md-5">
          <label for="area">Area:</label>
          <input type="text" id="area" class="form-control">
          <input type="hidden" id="noArea">
        </div>

        <div class="col-md-5">
          <label for="nomProducto">Producto:</label>
          <input type="text" id="nomProducto" class="form-control">
          <input type="hidden" id="producto">
        </div>
        <div class="col-md-2">
          <label for="tipo">Tipo:</label>
          <input type="text" id="tipo" class="form-control">
        </div>
        <div class="col-md-5">
          <label for="noControl"># Control:</label>
          <input type="text" id="noControl" class="form-control">
        </div>

        <div class="col-md-2">
          <label for="cantidad">Cantidad:</label>
          <input type="number" id="cantidad" class="form-control" min="0">
        </div>
        <div class="col-md-2">
          <br><br>
          <span id="spnUMedida">MED.</span>
        </div>
        <div class="col-md-4">
          <label for="fechaLim">Fecha límite para devolución:</label>
          <input type="date" id="fechaLim" class="form-control fecha">
        </div>
        <div class="col-md-4">
          <label for="fechaDev">Fecha de devolución:</label>
          <input type="date" id="fechaDev" class="form-control fecha">
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-sm-6 text-center">
        <button type="button" id="btnReiConCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
      </div>
      <div class="col-sm-6 text-center">
        <button type="button" id="btnReiConAceptar" class="btn btn-block btnAction btnAcept">REINGRESAR</button>
      </div>
    </div>
  </div>
@STOP


@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //              VARIABLES GLOBALES
      //---------------------------------------------------
      var gListaSalidas = new Array();
      var gHoy = new Date();
      gHoy.setHours(0,0,0,0);
      gHoy.setDate(gHoy.getDate() + 1);

      //              CONDICIONES INICIALES
      //---------------------------------------------------
      $('[data-toggle="tooltip"]').tooltip();
      $(".fondoTransparencia, .fondoTransparencia2, .aviso, .divForm").hide();
      getSalidas();
      readonly('#noSalida, text', true);
      readonly('#nombre, text', true);
      readonly('#area, text', true);
      readonly('#nomProducto, text', true);
      readonly('#tipo, text', true);
      readonly('#noControl, text', true);
      readonly('#fechaLim, text', true);

      //                ACCIONES DEL DOM
      //---------------------------------------------------
      $("#bloLisSalidas").on('click', '.showList', function(){   //-- muestra u oculta la tabla con la lista de productos de la entrada
        if( $("#listProdTable-"+ $(this).attr('data') ).attr('status') == 'hidden' ){
          $("#listProdTable-"+ $(this).attr('data') ).show();
          $("#listProdTable-"+ $(this).attr('data') ).attr('status', 'showed');
        } else if( $("#listProdTable-"+ $(this).attr('data') ).attr('status') == 'showed' ){
          $("#listProdTable-"+ $(this).attr('data') ).hide()
          $("#listProdTable-"+ $(this).attr('data') ).attr('status', 'hidden');
        }
      });
      $("#bloLisSalidas").on('click', '.returnBtn', function(){
        $(".fondoTransparencia, .divForm").show();
        for(var x=0; x<(gListaSalidas).length; x++){
          if( $(this).attr('noSalida') == gListaSalidas[x]['id'] ){
            $("#noSalida").val( gListaSalidas[x]['id'] );
            $("#nombre").val( gListaSalidas[x]['nomSol'] );
            $("#area").val( gListaSalidas[x]['are_nombre'] );
            $("#noArea").val( gListaSalidas[x]['noArea'] );

            for(var y=0; y<(gListaSalidas[x]['listSalida']).length; y++){
              if( $(this).attr('producto') == gListaSalidas[x]['listSalida'][y]['producto'] && $(this).attr('noControl') == gListaSalidas[x]['listSalida'][y]['noControl'] ){
                $("#nomProducto").val( gListaSalidas[x]['listSalida'][y]['pro_producto'] );
                $("#producto").val( gListaSalidas[x]['listSalida'][y]['producto'] );
                $("#tipo").val( gListaSalidas[x]['listSalida'][y]['cat_tipo'] );
                $("#noControl").val( gListaSalidas[x]['listSalida'][y]['noControl'] );
                $("#limite").val( parseFloat(gListaSalidas[x]['listSalida'][y]['cantidad']) - parseFloat(gListaSalidas[x]['listSalida'][y]['reingresado']) );

                if( gListaSalidas[x]['listSalida'][y]['cat_tipo'] == 'BII'){
                  readonly('#cantidad, text', true);
                  $("#cantidad").val( parseFloat(gListaSalidas[x]['listSalida'][y]['cantidad']) - parseFloat(gListaSalidas[x]['listSalida'][y]['reingresado']) );
                } else {
                  readonly('#cantidad, text', false);
                  $("#cantidad").val( parseFloat(gListaSalidas[x]['listSalida'][y]['cantidad']) - parseFloat(gListaSalidas[x]['listSalida'][y]['reingresado']) );
                }

                $("#spnUMedida").html( gListaSalidas[x]['listSalida'][y]['cat_uMedida'] );
                break;
              }
            }

            $("#fechaLim").val( gListaSalidas[x]['fechaDev'] );
            $("#fechaDev").val( gHoy.toISOString().slice(0,10) );

            break;
          }
        }
      });
      $(".btnCancel").click(function(){
        $(".fondoTransparencia, .divForm").hide();
        $('#forReiCon')[0].reset();
      });
      $(".btnAcept").click(function(){
        if( parseFloat($("#cantidad").val()) > parseFloat($("#limite").val()) ){
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; tu cantidad de productos a reingresar es mayor a los de salida');
        } else {
          addReingreso();
        }
      });

      //                FUNCIONES GENERALES
      //---------------------------------------------------
      function muestraAviso(tipo, mensaje) {
        if(tipo == 'success'){ $(".aviso").addClass('success') }
        $(".aviso").html(mensaje);
        $(".aviso").show(500);
        setTimeout( function(){
          $(".aviso").hide();
          $(".aviso").removeClass('success');
          //$(".fondoTransparencia").hide();
        } ,3000);
      }

      function pintaLista(){
        console.log(gListaSalidas);
        var lista = ''+
          '<table class="table table-sm tabLisSalidas">'+
            '<thead>'+
              '<th>#</th> <th>fechaSalida</th> <th>Solicita</th>'+
              '<th>fechaDev</th> <th>Area</th> <th>status</th> <th>Lista de productos</th>'+
            '</thead>'+
            '<tbody>';

        for(var x=0; x<(gListaSalidas).length; x++){
          lista += ''+
          '<tr>'+
            '<td class="text-center">'+gListaSalidas[x]['id']+'</td>'+
            '<td>'+gListaSalidas[x]['fechaSalida']+'</td>'+
            '<td>'+gListaSalidas[x]['nomSol']+'</td>'+
            '<td>'+((gListaSalidas[x]['fechaDev'] != '0000-00-00')? gListaSalidas[x]['fechaDev'] : 'N/A')+'</td>'+
            '<td>'+gListaSalidas[x]['are_nombre']+'</td>';


          if( gListaSalidas[x]['status'] == 0 ){
            lista += '<td class="text-center">&nbsp;</td>';
          } else if( gListaSalidas[x]['status'] == 1 ) {
            lista += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i></td>';
          } else if( gListaSalidas[x]['status'] == 2 ) {
            var fDev = new Date( gListaSalidas[x]['fechaDev'] );
            if( fDev > gHoy ){
              lista += '<td class="text-center textBlue"><i class="far fa-clock fa-lg"></i></td>';
            } else {
              lista += '<td class="text-center textRed"><i class="far fa-clock fa-lg"></i></td>';
            }
          }

            lista += ''+
              '<td>'+
                 '<button class="showList" data="'+gListaSalidas[x]['id']+'"><i class="fas fa-list-ul fa-lg"></i></button>'+
                 '<table  class="table table-sm listProdTable" id="listProdTable-'+gListaSalidas[x]['id']+'" status="hidden">'+
                   '<thead> <td>#</td> <td>Producto</td> <td># Control</td> <td>Cantidad</td> <td>Acción</td> </thead>';

           for(var y=0; y<(gListaSalidas[x]['listSalida']).length; y++){
             lista += '<tr>'+
                         '<td>'+(y+1)+'</td>'+
                         '<td>'+gListaSalidas[x]['listSalida'][y]['pro_producto']+'</td>'+
                         '<td>'+((gListaSalidas[x]['listSalida'][y]['noControl'] == 0)? "N/A" : gListaSalidas[x]['listSalida'][y]['noControl'])+'</td>'+
                         '<td>'+gListaSalidas[x]['listSalida'][y]['cantidad']+' '+gListaSalidas[x]['listSalida'][y]['cat_uMedida']+'.</td>'+
                         '<td class="text-center">';
             if( parseFloat(gListaSalidas[x]['listSalida'][y]['cantidad']) <= parseFloat(gListaSalidas[x]['listSalida'][y]['reingresado']) ){
               lista += '<span class="textGreen"><i class="fas fa-check fa-lg"></i></span>';
             } else {
               lista += '<button type="button" class="returnBtn" noSalida="'+gListaSalidas[x]['id']+'" producto="'+gListaSalidas[x]['listSalida'][y]['producto']+'" noControl="'+gListaSalidas[x]['listSalida'][y]['noControl']+'"><i class="fas fa-recycle fa-lg"></i></button>';
             }

             lista += ''+
                         '</td>'+
                       '</tr>';
           }

           lista+=''+
               '</table>'+
              '</td>'+
            '</tr>';
        }

        lista += ''+
            '</tbody>'+
          '</table>';

        $("#bloLisSalidas").html(lista);
        $(".listProdTable").hide();
        $("#listProdTable-1").hide();
        $('.tabLisSalidas').DataTable({
          "order": [[ 0, "desc" ]],
          "retrieve": true,
          "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
          "paging": false,
          "info": false

        });
      }


      //--  Configura datepicker a español
      $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
        };
      $.datepicker.setDefaults($.datepicker.regional['es']);
      $(function () {
        $(".fecha").datepicker();
      });

      //                  FUNCIONES AJAX
      //---------------------------------------------------
      //--obtén la salida
      function getSalidas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/reingresos/getSalidas') }}"
        })
        .done(function(data){
          console.log('getSalidas(ok)');
          gListaSalidas = $.parseJSON(data);
          pintaLista();
        })
        .fail(function(){
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('getSalidas("falló")');
        });
      };

      //--gaurda los datos del reingreso
      function addReingreso(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", noSalida:$("#noSalida").val(), nombre:$("#nombre").val(),
            noArea:$("#noArea").val(), producto:$("#producto").val(), tipo:$("#tipo").val(),
            noControl:$("#noControl").val(), cantidad:$("#cantidad").val(), fechaLim:$("#fechaLim").val(),
            fechaDev:$("#fechaDev").val(), anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/reingresos/addReingreso') }}"
        })
        .done(function(data){
            console.log('addReingreso("ok")');
            data = $.parseJSON(data);
            for(var x=0; x<gListaSalidas.length; x++){
              if( gListaSalidas[x]['id'] == data['id'] ) {
                gListaSalidas[x] = data;
                break;
              }
            }
            $(".fondoTransparencia, .divForm").hide();
            $('#forReiCon')[0].reset();
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Salida registrada exitosamente');
            pintaLista();
        })
        .fail(function(){
            muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('addReingreso("falló")');
        });
      }

    });
  </script>
@STOP
