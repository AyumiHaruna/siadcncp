@EXTENDS('almacen.layouts.masterAlmacenReportes')

@SECTION('title')
  Almacen - Reporte de Existencias
@STOP


@SECTION('moreStyles')
  <script src="{{asset('../js/jquery.dataTables.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/almacen/reporteExistencias.css')}}">
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
          LISTA DE EXISTENCIAS
      </div>
      <div class="col-md-2">
        <i class="fa fa-list fa-lg" aria-hidden="true"></i>
      </div>
    </div>

    <div class="row divControl">
      <div class="col-md-3"> <label for="forLinea">LINEA</label><select class="form-control" id="forLinea"><option value="">---</option></select> </div>
      <div class="col-md-3"> <label for="forCategoria">CATEGORIA</label> <br> <select class="form-control" id="forCategoria"><option value="">---</option></select> </div>
      <div class="col-md-1 text-center"> <button type="button" name="button" class="srcButton" id="btnSearch"><i class="fa fa-search fa-2x" aria-hidden="true"></i></button> </div>
      <div class="col-md-5">&nbsp;</div>
    </div>

    <div class="row">
      <div class="col-md-12  table-responsive">
        <table class="table table-sm tablaForm" id="tablaDatos">
          <thead>
            <tr>
              <th>Producto</th><th>Categoría</th><th>Linea</th><th>Tipo</th><th>Stock Mínimo</th>
              <th>Stock</th><th>Disponible</th><th>NoDisponile</th><th class="text-center">-</th> <th class="text-center">-</th> <th class="text-center">Lista de Productos</th>
            </tr>
          </thead>
          <tbody id="tablaStock">

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV DETALLES DE LA SALIDA ////////////////////////////////// -->
  <div class="col-md-10 offset-md-1 divForm" id="divLisProductos">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url({{asset('../img/almacen/entradas/prodIcon.png')}})">
          Detalles del Producto
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 divClose text-right">
        <button type="button" class="closeWindow" id="btnCloLisPro"><i class="fas fa-times fa-2x"></i></button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" id="bloLisProEspecificos">

      </div>
    </div>
  </div>
@STOP


@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //                VARIABLES GLOBALES
      //---------------------------------------------------
      gListaFullStock = [];
      gListaLineas = [];
      gListaCategorias = [];
      gTestData = 0;

      //                CONDICIONES INICIALES
      //---------------------------------------------------
      $('[data-toggle="tooltip"]').tooltip();
      $(".fondoTransparencia, .aviso, #divLisProductos").hide();
      ajaxGetFullStock();
      $('[data-toggle="tooltip"]').tooltip();  //inicializa etiquetas tooltip

      //                ACCIONES DEL DOM
      //---------------------------------------------------
      //-- cambió el form de linea o cat
      $(".form-control").change(function(){
        pintaLista( $("#forLinea").val(), $("#forCategoria").val() );
      });

      //-- Se pide buscar una lin o cat
      $("#btnSearch").click(function(){
        pintaTabla( $("#forLinea").val(), $("#forCategoria").val() );
      });

      $("#tablaStock").on('click', '.listBtn', function(){   //-- muestra u oculta la tabla con la lista de productos de la entrada
        if( $("#listProdTable-"+ $(this).attr('id') ).attr('status') == 'hidden' ){
          $("#listProdTable-"+ $(this).attr('id') ).show();
          $("#listProdTable-"+ $(this).attr('id') ).attr('status', 'showed');
        } else if( $("#listProdTable-"+ $(this).attr('id') ).attr('status') == 'showed' ){
          $("#listProdTable-"+ $(this).attr('id') ).hide()
          $("#listProdTable-"+ $(this).attr('id') ).attr('status', 'hidden');
        }
      });

      $("#tablaStock").on('click', '.infoBtn', function(){   //-- muestra u oculta la tabla con la lista de productos de la entrada
        pintaProdEspecifico( $(this).attr('id') );
        $("#divLisProductos, .fondoTransparencia").show(500)
      });

      $(".closeWindow").click(function(){
        $(".fondoTransparencia, #divLisProductos").hide();
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

      //pinta listas para buscadores
      function pintaLista(lin, cat){
        switch (true) {
          case (lin == "" && cat == ""):    //--ambos filtros vacios (carga Lista de Lineas)
            thisLineas = '<option value=""> Seleccione una Linea --- </option>';
            thisCategorias = '<option value=""> --- </option>';
            for (var x = 0; x < gListaLineas.length; x++) {
              thisLineas += '<option value="'+gListaLineas[x]['linea']+'">'+gListaLineas[x]['linea']+'</option>';
            }
            $("#forLinea").html(thisLineas);
            $("#forCategoria").html(thisCategorias)

            break;

          case (lin != "" && cat == ""):  //--linea notNull y cat Null (carga Categorias de esta linea)
            thisCategorias = '<option value=""> Seleccione una Categoría --- </option>';
            for (var x = 0; x < gListaCategorias.length; x++) {
              if( gListaCategorias[x]['linea'] == lin ){
                thisCategorias += '<option value="'+gListaCategorias[x]['categoria']+'">'+gListaCategorias[x]['categoria']+'</option>';
              }
            }
            $("#forCategoria").html(thisCategorias);

            break;

          case (lin != "" && cat != ""):  //--lin notNull y cat notNull (prueba si Cat pertenece a Lin)
            for (var x = 0; x < gListaCategorias.length; x++) {   //--recorre el array en busqueda de la categoría
              if( gListaCategorias[x]['categoria'] == cat ) {  //--encuentra la categoria seleccionada
                //-- haz el test
                if(gListaCategorias[x]['linea'] == lin){ //--si la categoria pertenece a esta linea pinta

                } else {  //-- si no, limpia la lista de categorias
                  thisCategorias = '<option value=""> Seleccione una Categoría --- </option>';
                  for (var x = 0; x < gListaCategorias.length; x++) {
                    if( gListaCategorias[x]['linea'] == lin ){
                      thisCategorias += '<option value="'+gListaCategorias[x]['categoria']+'">'+gListaCategorias[x]['categoria']+'</option>';
                    }
                  }
                  $("#forCategoria").html(thisCategorias);

                }
              }
            }
            break;

          case ( lin == "" && cat != ""):
            thisLineas = '<option value=""> Seleccione una Linea --- </option>';
            thisCategorias = '<option value=""> --- </option>';
            for (var x = 0; x < gListaLineas.length; x++) {
              thisLineas += '<option value="'+gListaLineas[x]['linea']+'">'+gListaLineas[x]['linea']+'</option>';
            }
            $("#forLinea").html(thisLineas);
            $("#forCategoria").html(thisCategorias)
            pintaTabla(lin, cat);
            break;
        }
        console.log('pintaLista(Ok)');
      }

      //--dibuja la tabla de stock segun los filtros
      function pintaTabla(lin, cat){
        lista = ''
        for (var x = 0; x < gListaFullStock.length; x++) {
          lista += '<tr ';

            switch (true) {
              case (lin == "" && cat == ""):  lista += '">';   break;
              case (lin != "" && cat == ""):  lista += ((gListaFullStock[x]['linea'] == lin) ? '">' : 'inhabil">');   break;
              case (lin != "" && cat != ""):  lista += ((gListaFullStock[x]['linea'] == lin && gListaFullStock[x]['categoria'] == cat ) ? '">' : 'inhabil">');  break;
            }

            lista += ''+
              '<td>'+gListaFullStock[x]['producto']+'</td>'+
              '<td>'+gListaFullStock[x]['categoria']+'</td>'+
              '<td>'+gListaFullStock[x]['linea']+'</td>';

            /*switch(gListaFullStock[x]['tipo']){
              case 'CON':   lista += '<td>CONSUMIBLE</td>';    break;
              case 'BIN':   lista += '<td>BIEN NO INVENTARIABLE</td>';    break;
              case 'BII':   lista += '<td>BIEN INVENTARIABLE</td>';    break;
            }*/
            lista += '<td class="text-center">'+gListaFullStock[x]['tipo']+'</td>';

            lista += '<td class="text-right">'+gListaFullStock[x]['minStock']+' '+gListaFullStock[x]['uMedida']+'</td>';

            //---------------------------------------------------

            if(gListaFullStock[x]['datosStock'] != undefined){    //si existe stock de este productos
              switch (true) {
                case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) > parseFloat(gListaFullStock[x]['minStock']) ):
                  var flag = 'textGreen';    break;
                case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) == parseFloat(gListaFullStock[x]['minStock']) ):
                  var flag = 'textYellow';    break;
                case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) < parseFloat(gListaFullStock[x]['minStock']) ):
                  var flag = 'textRed';    break;
              }

              lista += ''+
              '<td class="'+flag+' text-right">'+gListaFullStock[x]['datosStock']['stock']+' '+gListaFullStock[x]['uMedida']+'</td>'+
              '<td class="'+flag+' text-right">'+gListaFullStock[x]['datosStock']['disponible']+' '+gListaFullStock[x]['uMedida']+'</td>'+
              '<td class="'+flag+' text-right">'+gListaFullStock[x]['datosStock']['noDisponible']+' '+gListaFullStock[x]['uMedida']+'</td>';

              if( gListaFullStock[x]['LinActivo'] == 0 || gListaFullStock[x]['catActivo'] == 0 || gListaFullStock[x]['prodActivo'] == 0 ){
                lista += '<td class="blulbFlag text-center" data-toggle="tooltip" title="Producto Inactivo"><i class="far fa-lightbulb fa-lg"></i></td>';
              } else {
                lista += '<td></td>';
              }

              switch (true) {
                case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) > parseFloat(gListaFullStock[x]['minStock']) ):
                  lista += '<td class="textGreen text-center"><i class="fas fa-thermometer-full fa-2x"></i></td>';    break;
                case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) == parseFloat(gListaFullStock[x]['minStock']) ):
                  lista += '<td class="textYellow text-center"><i class="fas fa-thermometer-half fa-2x"></i></td>';    break;
                case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) < parseFloat(gListaFullStock[x]['minStock']) ):
                  lista += '<td class="textRed text-center"><i class="fas fa-thermometer-empty fa-2x"></i></td>';    break;
              }

              if(gListaFullStock[x]['datosStock']['sub'] == 1){
                lista += '<td class="text-center"><button type="button" class="listBtn" id="'+gListaFullStock[x]['id']+'"><i class="fas fa-list-ul fa-lg"></i></button>'+
                  '<table class="listProdTable"  id="listProdTable-'+gListaFullStock[x]['id']+'" status="hidden"><thead><td>#</td> <td>NoControl</td> <td>Disponible</td> <td>#Comisión</td>'+
                  '<td>Comisionado</td></thead>';

                for(var y=0; y<(gListaFullStock[x]['datosStock']['listaStock']).length; y++){
                  lista += '<tr>'+
                              '<td>'+(y+1)+'</td>'+
                              '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['noControl']+'</td>';

                  if( gListaFullStock[x]['datosStock']['listaStock'][y]['disp'] == 1 ) {
                    lista += '<td class="text-center thumbUp"><i class="fas fa-thumbs-up fa-lg"></i></td>';
                  } else {
                    lista += '<td class="text-center thumbDown"><i class="fas fa-thumbs-down fa-lg"></i></td>';
                  }

                  lista += ''+
                              '<td>'+((gListaFullStock[x]['datosStock']['listaStock'][y]['noComision'] == undefined)? 'N/A' : gListaFullStock[x]['datosStock']['listaStock'][y]['noComision'] )+'</td>'+
                              '<td>'+((gListaFullStock[x]['datosStock']['listaStock'][y]['comisionado'] == undefined)? 'N/A' : gListaFullStock[x]['datosStock']['listaStock'][y]['comisionado'] )+'</td>'+
                            '</tr>'
                }
                lista += '<tr><td colspan="5"><button type="button" class="infoBtn" id="'+gListaFullStock[x]['id']+'"><i class="fas fa-plus fa-lg"></i> Información</button></td></tr>'+
                    '</table>'+
                  '</td>';

              } else {
                lista += '<td>&nbsp</td>';
              }
            } else {
              flag = 'textRed';
              lista += ''+
              '<td class="'+flag+' text-right">- '+gListaFullStock[x]['uMedida']+'</td>'+
              '<td class="'+flag+' text-right">- '+gListaFullStock[x]['uMedida']+'</td>'+
              '<td class="'+flag+' text-right">- '+gListaFullStock[x]['uMedida']+'</td>'+
              '<td>&nbsp;</td>'+
              '<td class="textRed text-center"><i class="fas fa-thermometer-empty fa-2x"></i></td>'+
              '<td>&nbsp;</td>';
            }


            //---------------------------------------------------

            lista += '</tr>';
          }

        $("#tablaStock").html(lista);
        $(".listProdTable").hide();
        $('#tablaDatos').DataTable({
          "order": [[ 0, "desc" ]],
          "retrieve": true,
          "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
          "paging": false,
          "info": false
        });
        console.log('pintaTabla (ok)');
      }

      //-- pinta la lista de entradas especifica
      function pintaProdEspecifico(id){
        console.log('pintaProdEspecifico("ok")');
        for( var x=0; x<gListaFullStock.length; x++){
          if( gListaFullStock[x]['id'] == id ){
            var lista = ''+
              '<div class="row">'+
                  '<div class="col-md-2 textBold"> # </div>'+
                  '<div class="col-md-8 textBold"> Producto: </div>'+
                  '<div class="col-md-2 textBold"> Activo: </div>'+
                  '<div class="col-md-2 textAnswere">'+gListaFullStock[x]['id']+'</div>'+
                  '<div class="col-md-8 textAnswere">'+gListaFullStock[x]['producto']+'</div>';

                  if( gListaFullStock[x]['LinActivo'] == 0 || gListaFullStock[x]['catActivo'] == 0 || gListaFullStock[x]['prodActivo'] == 0 ){
                    lista += '<div class="col-md-2 textAnswere text-center thumbDown"><i class="fas fa-thumbs-down fa-lg"></i></div>';
                  } else {
                    lista += '<div class="col-md-2 textAnswere text-center thumbUp"><i class="fas fa-thumbs-up fa-lg"></i></div>';
                  }

          lista += ''+
                  '<div class="col-md-5 textBold"> Categoría: </div>'+
                  '<div class="col-md-5 textBold"> Linea: </div>'+
                  '<div class="col-md-2 textBold"> Tipo: </div>'+
                  '<div class="col-md-5 textAnswere">'+gListaFullStock[x]['categoria']+'</div>'+
                  '<div class="col-md-5 textAnswere">'+gListaFullStock[x]['linea']+'</div>'+
                  '<div class="col-md-2 textAnswere">'+gListaFullStock[x]['tipo']+'</div>'+

                  '<div class="col-md-3 textBold"> Stock Mínimo: </div>'+
                  '<div class="col-md-3 textBold"> Stock Actual: </div>'+
                  '<div class="col-md-3 textBold"> Disponible: </div>'+
                  '<div class="col-md-3 textBold"> No Disponible: </div>'+
                  '<div class="col-md-3 textAnswere">'+gListaFullStock[x]['minStock']+' '+gListaFullStock[x]['uMedida']+'</div>';

                  switch (true) {
                    case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) > parseFloat(gListaFullStock[x]['minStock']) ):
                      var flag = 'letterGreen';    break;
                    case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) == parseFloat(gListaFullStock[x]['minStock']) ):
                      var flag = 'letterYellow';    break;
                    case ( parseFloat(gListaFullStock[x]['datosStock']['disponible']) < parseFloat(gListaFullStock[x]['minStock']) ):
                      var flag = 'letterRed';    break;
                  }

          lista += ''+
                  '<div class="col-md-3 textAnswere '+flag+'">'+gListaFullStock[x]['datosStock']['stock']+' '+gListaFullStock[x]['uMedida']+'</div>'+
                  '<div class="col-md-3 textAnswere '+flag+'">'+gListaFullStock[x]['datosStock']['disponible']+' '+gListaFullStock[x]['uMedida']+'</div>'+
                  '<div class="col-md-3 textAnswere '+flag+'">'+gListaFullStock[x]['datosStock']['noDisponible']+' '+gListaFullStock[x]['uMedida']+'</div>'+
              '<div class="col-md-12">';

              lista += ''+
              '<table class="table table-sm" id="tabLista">'+
                '<thead>'+
                  '<tr>'+
                    '<th>#</th>'+
                    '<th>No. de Control</th>'+
                    '<th>Disponible</th>'+
                    '<th>No. de Comisión</th>'+
                    '<th>Comisionado</th>'+
                    '<th>No. de Serie</th>'+
                    '<th>Marca</th>'+
                    '<th>Modelo</th>'+
                    '<th>Observaciones</th>'+
                    '<th>Ubicación</th>'+
                  '<tr>'+
                '</thead>'+
                '<tbody>';

                for(var y=0; y<(gListaFullStock[x]['datosStock']['listaStock']).length; y++){
                    lista += '<tr>'+
                               '<td>'+(y+1)+'</td>'+
                               '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['noControl']+'</td>';

                               if( gListaFullStock[x]['datosStock']['listaStock'][y]['disp'] == 1 ) {
                                 lista += '<td class="text-center thumbUp"><i class="fas fa-thumbs-up fa-lg"></i></td>';
                               } else {
                                 lista += '<td class="text-center thumbDown"><i class="fas fa-thumbs-down fa-lg"></i></td>';
                               }

                      lista += ''+
                               '<td>'+((gListaFullStock[x]['datosStock']['listaStock'][y]['noComision'] == undefined)? 'N/A' : gListaFullStock[x]['datosStock']['listaStock'][y]['noComision'] )+'</td>'+
                               '<td>'+((gListaFullStock[x]['datosStock']['listaStock'][y]['comisionado'] == undefined)? 'N/A' : gListaFullStock[x]['datosStock']['listaStock'][y]['comisionado'] )+'</td>'+
                               '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['noSerie']+'</td>'+
                               '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['marca']+'</td>'+
                               '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['modelo']+'</td>'+
                               '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['obs']+'</td>'+
                               '<td>'+gListaFullStock[x]['datosStock']['listaStock'][y]['ubicacion']+'</td>'+
                             '</tr>';
                }
        lista +='</tbody>'+
              '</table>'+
            '</div>';
            $("#bloLisProEspecificos").html(lista);
          }
        }
      }


      //                FUNCIONES AJAX
      //---------------------------------------------------
      //-- Obtiene la lita completa de existencias
      function ajaxGetFullStock(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/reportes/existencias/getFullStock') }}"
        })
        .done(function(data){
          console.log('ajaxGetFullStock(ok)');
          gListaFullStock = $.parseJSON(data);
          ajaxGetListas();
          pintaTabla( $("#forLinea").val(), $("#forCategoria").val() );
        })
        .fail(function(){
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxGetFullStock("falló")');
        });
      }

      //-- Obtiene la lista de Lineas y Categorias
      //obtiene la lista de Lineas y Categorias
      function ajaxGetListas(){
        //-- Obtiene la lista de lineas
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/reportes/existencias/getLineas') }}"
        })
        .done(function(data){
          console.log('ajaxGetListasLineas(ok)');
          gListaLineas = $.parseJSON(data);

          //-- Obtiene la lista de Categoris
          $.ajax({
              data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/reportes/existencias/getCategorias') }}"
          })
          .done(function(data){
            console.log('ajaxGetListasCategorias(ok)');
            gListaCategorias = $.parseJSON(data);
            pintaLista( $("#forLinea").val(), $("#forCategoria").val() );
          })
          .fail(function(){
            muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxGetListasCategorias("falló")');
          });

        })
        .fail(function(){
          muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxGetListasLineas("falló")');
        });
      }
    });
  </script>
@STOP
