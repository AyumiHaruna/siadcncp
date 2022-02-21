@EXTENDS('almacen.layouts.masterAlmacenReportes')

@SECTION('title')
  Almacen - Reporte de Salidas
@STOP


@SECTION('moreStyles')
  <script src="{{asset('../js/jquery.dataTables.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/almacen/reporteSalidas.css')}}">
@STOP


@SECTION('content')
  <!--  /////////////////////////// DIV TRANSPARENCIA ////////////////////////// -->
  <div class="fondoTransparencia"></div>

  <!--  /////////////////////////// DIV AVISO ////////////////////////////////// -->
  <div class="col-md-4 offset-md-4 aviso text-center"></div>

  <!--  /////////////////////////// MAIN DIV ////////////////////////////////// -->
  <div class="col-md-12 main-div">
    <div class="row subTitle">
      <div class="col-md-10 text-center">
          REPORTE DE SALIDAS Y REINGRESOS
      </div>
      <div class="col-md-2">
        <i class="fa fa-list fa-lg" aria-hidden="true"></i>
      </div>
    </div>

    <div class="row divControl">
      <div class="col-md-8 offset-md-2">
        <div class="row">
          <div class="col-sm-6">
            <button type="button" class="btn btn-block btnSelList btnSelListActive" style="background-image:url({{asset('../img/almacen/catalogo/phase1.png')}})" id="btnPorSalidas">Por Salida</button>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-block btnSelList" style="background-image:url({{asset('../img/almacen/catalogo/phase2.png')}})" id="btnPorProductos">Por Productos</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- BLOQUE CON LISTA POR SALIDAS -->
      <div class="col-md-12  table-responsive" id="divLisSalida">
        <table class="table table-sm tablaForm" id="tabDatSalidas">
          <thead>
              <th>#</th><th>Fecha de Salida</th><th>Solicitante</th><th>Área</th><th>Destino</th>
              <th>Fecha de Devolución</th><th>Observaciones</th><th>Status</th><th>Lista de Productos</th>
          </thead>
          <tbody class="tablaReporte" id="tablaSalidas">

          </tbody>
        </table>
      </div>

      <!-- BLOQUE CON LISTA POR PRODUCTOS -->
      <div class="col-md-12  table-responsive" id="divLisProductos">
        <table class="table table-sm tablaForm" id="tabDatosProductos">
          <thead>
            <th>#</th><th>No. Salida</th><th>Fecha de Salida</th><th>Solicitante</th><th>Área</th><th>Producto</th><th>Categoría</th>
            <th>Línea</th><th>Tipo</th><th>Fecha de Devolución</th><th>Cantidad</th><th>Status</th><th>Reingresados</th>
            <th>Fecha del Reingreso</th>
          </thead>
          <tbody class="tablaReporte" id="tablaProductos">

          </tbody>
        </table>
      </div>
    </div>






  </div>

@STOP


@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //                VARIABLES GLOBALES
      //---------------------------------------------------
      var gData = new Array();

      //                CONDICIONES INICIALES
      //---------------------------------------------------
      $('[data-toggle="tooltip"]').tooltip();
      $(".fondoTransparencia, .aviso, #divLisProductos").hide();
      getSalidas();

      //                ACCIONES DEL DOM
      //---------------------------------------------------
      //selecciona la lista que se desa mostrar
      $(".btnSelList").click(function(){
        $("#btnPorSalidas, #btnPorProductos").removeClass("btnSelListActive");
        $(this).addClass('btnSelListActive');
        switch ( $(this).attr('id') ) {
          case 'btnPorSalidas':
            $("#divLisProductos").hide();
            $("#divLisSalida").show();
          break;
          case 'btnPorProductos':
            $("#divLisSalida").hide();
            $("#divLisProductos").show();
          break;
        }
      });

      //muestra la lista de productos para una salida
      $("#tablaSalidas").on('click', '.listBtn', function(){
        if( $("#listProdTable-"+ $(this).attr('id') ).attr('status') == 'hidden' ){
          $("#listProdTable-"+ $(this).attr('id') ).show();
          $("#listProdTable-"+ $(this).attr('id') ).attr('status', 'showed');
        } else if( $("#listProdTable-"+ $(this).attr('id') ).attr('status') == 'showed' ){
          $("#listProdTable-"+ $(this).attr('id') ).hide()
          $("#listProdTable-"+ $(this).attr('id') ).attr('status', 'hidden');
        }
      });

      //                FUNCIONES GENERALES
      //---------------------------------------------------
      //-- muestra mensajes de aviso
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

      //-- generamos ambas tablas y las pintamos en sus respectivos divForStock
      function pintaTablas(){
        var lista1 = '';      var lista2 = '';
        //pintando lista1           (separaré los procesos de cada lista para evitar confundir)
        for(var x=0; x<gData.length; x++){
          console.log(gData[x]);
          lista1 += ''+
          '<tr>'+
            '<td>'+gData[x]['id']+'</td> <td>'+gData[x]['fechaSalida']+'</td><td>'+gData[x]['nomSol']+'</td>'+
            '<td>'+gData[x]['are_nombre']+'</td> <td>'+gData[x]['destino']+'</td>'+
            '<td>'+((gData[x]['fechaDev'] != '0000-00-00')? gData[x]['fechaDev'] : 'N/A')+'</td>'+
            '<td>'+gData[x]['obs']+'</td>';

            switch (gData[x]['status']) {
              case 0:
                    lista1 += '<td>&nbsp;</td>';
              break;
              case 1:
                    lista1 += '<td class="letterBlue text-center"><i class="fas fa-stopwatch fa-lg"></i><span class="spnHiden">b</span></td>';
              break;
              case 2:
                    lista1 += '<td class="letterGreen text-center"><i class="fas fa-check fa-lg"></i><span class="spnHiden">a</span></td>';
              break;
            }

          lista1 += ''+
            '<td>'+
              '<button type="button" class="listBtn" id="'+gData[x]['id']+'"><i class="fas fa-list-ul fa-lg"></i></button>'+
              '<table class="listProdTable"  id="listProdTable-'+gData[x]['id']+'" status="hidden">'+
              '<thead><td>#</td> <td>Producto</td> <td>NoControl</td> <td>tipo</td> <td>Cantidad</td> <td>Status</td> <td>Reingresados</td><td>Fecha de Reingreso</td> </thead>';

            for(var y=0; y<(gData[x]['listSalida']).length; y++){
              lista1 += '<tr>'+
                          '<td>'+(y+1)+'</td>'+
                          '<td>'+gData[x]['listSalida'][y]['pro_producto']+'</td>'+
                          '<td>'+((gData[x]['listSalida'][y]['noControl'] != 0)? gData[x]['listSalida'][y]['noControl'] : 'N/A')+'</td>'+
                          '<td>'+gData[x]['listSalida'][y]['cat_tipo']+'</td>'+
                          '<td>'+gData[x]['listSalida'][y]['cantidad']+' '+gData[x]['listSalida'][y]['cat_uMedida']+'</td>';

              switch (true) {     //switch lvl0 (devolucion necesaria?)
                case ( gData[x]['fechaDev'] == '0000-00-00' ):
                    lista1 += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i></td>'+
                              '<td class="text-center letterGreen">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                              '<td class="text-center letterGreen">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                break;
                case ( gData[x]['fechaDev'] != '0000-00-00' ):
                      //obtengo fechas
                      var gHoy = new Date();
                      gHoy.setHours(0,0,0,0);
                      var gDev = new Date(gData[x]['fechaDev']);

                      switch (gData[x]['listSalida'][y]['cat_tipo'] == 'CON') {      //switch lvl1 (tipo de producto consumible?)
                        case true:
                              //no necesita ser reingresados para tener un status aprovatorio
                              lista1 += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i></td>'+
                                        '<td class="text-center letterGreen">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                        '<td class="text-center letterGreen">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                        break;
                        case false:
                              switch ( parseFloat( gData[x]['listSalida'][y]['reingresado'] ) >= parseFloat( gData[x]['listSalida'][y]['cantidad'] ) ) {      //switch lvl2 (ya reingresado?)
                                case true:
                                      gLast = new Date(gData[x]['listSalida'][y]['lastReingreso']);
                                      switch (gLast < gDev) {       //switch lvl3 (reingresó a tiempo?)
                                        case true:
                                              //reingresó a tiempo
                                              lista1 += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i></td>'+
                                                        '<td class="text-center letterGreen">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                        '<td class="text-center letterGreen">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                        break;
                                        case false:
                                              //reingresó fuera de tiempo
                                              lista1 += '<td class="text-center textYellow"><i class="fas fa-check fa-lg"></i></td>'+
                                                        '<td class="text-center letterYellow">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                        '<td class="text-center letterYellow">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                        break;
                                      }
                                break;
                                case false:
                                     switch (gHoy < gDev) {  //switch lvl3 (aun en tiempo de reingresar?)
                                       case true:
                                             //aun en tiempo
                                             lista1 += '<td class="text-center textBlue"><i class="fas fa-stopwatch fa-lg"></i></td>'+
                                                       '<td class="text-center letterBlue">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                       '<td class="text-center letterBlue">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                       break;
                                       case false:
                                             //fuera de tiempo
                                             lista1 += '<td class="text-center textRed"><i class="fas fa-stopwatch fa-lg"></i></td>'+
                                                       '<td class="text-center letterRed">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                       '<td class="text-center letterBlue">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                       break;
                                     }
                                break;
                              }
                        break;
                      }
                break;
              } //end primer switch ('requiere devolucion?')
              lista1 += '</tr>';
            } //end for gData[x]['listSalida']
            lista1+= ''+
                '</table>';
            lista1+='</td>'+
          '</tr>';

        } // end for gData.length

        $("#tablaSalidas").html(lista1);
        $(".listProdTable").hide();
        $('#tabDatSalidas').DataTable({
          "order": [[ 0, "desc" ]],
          "retrieve": true,
          "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
          "paging": false,
          "info": false
        });

        //pintando lista1           (separaré los procesos de cada lista para evitar confundir)
        for(var x=0; x<gData.length; x++){
          for(var y=0; y<(gData[x]['listSalida']).length; y++){
            /*<th>#</th><th>No. Salida</th><th>Fecha de Salida</th><th>Solicitante</th><th>Área</th><th>Producto</th><th>Tipo</th>
            <th>Fecha de Devolución</th><th>Status</th><th>Cantidad</th><th>Reingresados</th><th>Fecha del Reingreso</th>*/
            lista2 += ''+
            '<tr>'+
              '<td class="text-center">'+gData[x]['listSalida'][y]['id']+'</td>'+'<td class="text-center">'+gData[x]['id']+'</td>'+
              '<td>'+gData[x]['fechaSalida']+'</td>'+'<td>'+gData[x]['nomSol']+'</td>'+'<td>'+gData[x]['are_nombre']+'</td>'+
              '<td>'+gData[x]['listSalida'][y]['pro_producto']+'</td>'+'<td>'+gData[x]['listSalida'][y]['cat_categoria']+'</td>'+
              '<td>'+gData[x]['listSalida'][y]['lin_linea']+'</td>'+'<td>'+gData[x]['listSalida'][y]['cat_tipo']+'</td>'+
              '<td>'+((gData[x]['fechaDev'] != '0000-00-00')? gData[x]['fechaDev'] : 'N/A')+'</td>'+
              '<td>'+gData[x]['listSalida'][y]['cantidad']+' '+gData[x]['listSalida'][y]['cat_uMedida']+'</td>';

              switch (true) {     //switch lvl0 (devolucion necesaria?)
                case ( gData[x]['fechaDev'] == '0000-00-00' ):
                    lista2 += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i><span class="spnHiden">a</span></td>'+
                              '<td class="text-center letterGreen">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                              '<td class="text-center letterGreen">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                break;
                case ( gData[x]['fechaDev'] != '0000-00-00' ):
                      //obtengo fechas
                      var gHoy = new Date();
                      gHoy.setHours(0,0,0,0);
                      var gDev = new Date(gData[x]['fechaDev']);

                      switch (gData[x]['listSalida'][y]['cat_tipo'] == 'CON') {      //switch lvl1 (tipo de producto consumible?)
                        case true:
                              //no necesita ser reingresados para tener un status aprovatorio
                              lista2 += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i><span class="spnHiden">a</span></td>'+
                                        '<td class="text-center letterGreen">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                        '<td class="text-center letterGreen">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                        break;
                        case false:
                              switch ( parseFloat( gData[x]['listSalida'][y]['reingresado'] ) >= parseFloat( gData[x]['listSalida'][y]['cantidad'] ) ) {      //switch lvl2 (ya reingresado?)
                                case true:
                                      gLast = new Date(gData[x]['listSalida'][y]['lastReingreso']);
                                      switch (gLast < gDev) {       //switch lvl3 (reingresó a tiempo?)
                                        case true:
                                              //reingresó a tiempo
                                              lista2 += '<td class="text-center textGreen"><i class="fas fa-check fa-lg"></i><span class="spnHiden">a</span></td>'+
                                                        '<td class="text-center letterGreen">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                        '<td class="text-center letterGreen">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                        break;
                                        case false:
                                              //reingresó fuera de tiempo
                                              lista2 += '<td class="text-center textYellow"><i class="fas fa-check fa-lg"></i><span class="spnHiden">b</span></td>'+
                                                        '<td class="text-center letterYellow">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                        '<td class="text-center letterYellow">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                        break;
                                      }
                                break;
                                case false:
                                     switch (gHoy < gDev) {  //switch lvl3 (aun en tiempo de reingresar?)
                                       case true:
                                             //aun en tiempo
                                             lista2 += '<td class="text-center textBlue"><i class="fas fa-stopwatch fa-lg"></i><span class="spnHiden">c</span></td>'+
                                                       '<td class="text-center letterBlue">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                       '<td class="text-center letterBlue">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                       break;
                                       case false:
                                             //fuera de tiempo
                                             lista2 += '<td class="text-center textRed"><i class="fas fa-stopwatch fa-lg"></i><span class="spnHiden">d</span></td>'+
                                                       '<td class="text-center letterRed">'+gData[x]['listSalida'][y]['reingresado']+'</td>'+
                                                       '<td class="text-center letterBlue">'+((gData[x]['listSalida'][y]['lastReingreso'] != "")? gData[x]['listSalida'][y]['lastReingreso'] : "N/A" )+'</td>';
                                       break;
                                     }
                                break;
                              }
                        break;
                      }
                break;
              } //end primer switch ('requiere devolucion?')

            lista2 += ''+
            '</tr>';
          }
        }

        $("#tablaProductos").html(lista2);
        $('#tabDatosProductos').DataTable({
          "order": [[ 1, "desc" ]],
          "retrieve": true,
          "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
          "paging": false,
          "info": false
        });

        console.log('pintaTabla (ok)');
      }




      //                FUNCIONES AJAX
      //---------------------------------------------------
      //-- Obtiene la lita completa de existencias
      function getSalidas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/reportes/repSalidas/getSalidas') }}"
        })
        .done(function(data){
          console.log('getSalidas(ok)');
          gData = $.parseJSON(data);
          pintaTablas();
        })
        .fail(function(){
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('getSalidas("falló")');
        });
      }


    });
  </script>
@STOP
