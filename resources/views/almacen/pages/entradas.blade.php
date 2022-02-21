@EXTENDS('almacen.layouts.masterAlmacen')

@SECTION('title')
  Almacen - Entradas
@STOP

@SECTION('moreStyles')
  <script src="{{asset('../js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('../js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('../js/readOnly.js')}}"></script>
  <link rel="stylesheet" href="{{asset('../css/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/almacen/entradas.css')}}">
@STOP

@SECTION('content')
  <!--  /////////////////////////// DIV TRANSPARENCIA ////////////////////////// -->
  <div class="fondoTransparencia"></div>
  <div class="fondoTransparencia2"></div>

  <!--  /////////////////////////// DIV AVISO ////////////////////////////////// -->
  <div class="col-md-4 offset-md-4 aviso text-center"></div>

  <!--  /////////////////////////// DIV MAIN ////////////////////////////////// -->
  <div class="col-md-12 main-div">
    <div class="row">
      <div class="col-md-9">
        <div class="subTitle text-center">
          LISTA DE ENTRADAS
        </div>
      </div>
      <!--<div class="col-md-1">  &nbsp;  </div>-->
      <div class="col-md-3">
        <button type="button" id="addEntrada" class="addButton">NUEVA ENTRADA &nbsp;&nbsp; <i class="far fa-plus-square fa-lg" aria-hidden="true"></i></button>
      </div>
    </div>
    <div class="row noPadd divLisEntradas" id="divLisEntradas">
      <div class="col-md-12 table-responsive" id="bloLisEntradas">

      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV FORM ADDENTRADA ////////////////////////////////// -->
  <div class="col-md-6 offset-md-3 divForm" id="divForEntrada">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/entradas/entradaIcon.png)">
          NUEVA ENTRADA
      </div>
    </div>
    <form id="formEntrada">
      <div class="row">
        <div class="col-md-6">
          <label for="forEntFolioFactura">Folio de la Factura:</label>
          <input type="text" id="forEntFolioFactura" class="form-control" maxlength="20"><br>
          <label for="forEntFechaIngreso">Fecha de Ingreso:</label>
          <input type="date" id="forEntFechaIngreso" class="form-control fecha"><br>
          <label for="forEntObs">Observaciones:</label>
          <textarea id="forEntObs" class="form-control"></textarea>
        </div>
        <div class="col-md-6">
          <label for="forEntFechaFactura">Fecha de la Factura:</label>
          <input type="date" id="forEntFechaFactura" class="form-control fecha"> <br>
          <label for="forEntMonto">Monto de la Factura:</label>
          <input type="number" id="forEntMonto" class="form-control" value="0.00"><br><br>
          <button type="button" id="addProducto" class="addButton">AÑADIR PRODUCTO &nbsp;&nbsp;<i class="far fa-plus-square fa-lg" aria-hidden="true"></i></button>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-center table-responsive">
          <table class="table table-sm tablaForm">
            <thead>
              <tr>
                <th>PRODUCTO</th> <th>CANT.</th>  <th># CONTROL</th> <th>QUITAR</th>
              </tr>
            </thead>
            <tbody id="bodAddProd">

            </tbody>
          </table>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-sm-6 text-center">
        <button type="button" id="btnEntCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
      </div>
      <div class="col-sm-6 text-center">
        <button type="button" id="btnEntAceptar" class="btn btn-block btnAction btnAcept">AGREGAR</button>
      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV MODIFICA ENTRADA ////////////////////////////////// -->
  <div class="col-md-6 offset-md-3 divForm" id="divForEdiEntrada">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/entradas/entradaIcon.png)">
          MODIFICAR ENTRADA
      </div>
    </div>
    <form id="formEdiEntrada">
      <div class="row">
        <div class="col-md-6">
          <input type="hidden" id="forEdiEntId">
          <label for="forEdiEntFolioFactura">Folio de la Factura:</label>
          <input type="text" id="forEdiEntFolioFactura" class="form-control" maxlength="20"><br>
          <label for="forEdiEntFechaIngreso">Fecha de Ingreso:</label>
          <input type="date" id="forEdiEntFechaIngreso" class="form-control fecha"><br>
          <label for="forEdiEntObs">Observaciones:</label>
          <textarea id="forEdiEntObs" class="form-control"></textarea>
        </div>
        <div class="col-md-6">
          <label for="forEdiEntFechaFactura">Fecha de la Factura:</label>
          <input type="date" id="forEdiEntFechaFactura" class="form-control fecha"> <br>
          <label for="forEdiEntMonto">Monto de la Factura:</label>
          <input type="number" id="forEdiEntMonto" class="form-control" value="0.00"><br><br>
          <button type="button" id="addProducto" class="addButton">AÑADIR PRODUCTO &nbsp;&nbsp;<i class="far fa-plus-square fa-lg" aria-hidden="true"></i></button>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-center table-responsive">
          <table class="table tablaForm">
            <thead>
              <tr>
                <th>PRODUCTO</th> <th>CANT.</th>  <th># CONTROL</th> <th>QUITAR</th>
              </tr>
            </thead>
            <tbody id="bodEdiProd">

            </tbody>
          </table>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-sm-6 text-center">
        <button type="button" id="btnEdiEntCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
      </div>
      <div class="col-sm-6 text-center">
        <button type="button" id="btnEdiEntAceptar" class="btn btn-block btnAction btnAcept">MODIFICAR</button>
      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV FORM ADDP RODUCTO  ////////////////////////////////// -->
  <div class="col-md-6 offset-md-3 divForm" id="divForProducto">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/entradas/prodIcon.png)">
          AÑADIR PRODUCTO
      </div>
    </div>

    <form id="formProducto">
      <div class="row">
        <div class="col-md-6">
          <label for="forProLinea">Linea: (*)</label>
          <select class="form-control" id="forProLinea"></select>
        </div>
        <div class="col-md-6">
          <label for="forProCategoria">Categoría: (*)</label>
          <select class="form-control" id="forProCategoria"></select>
        </div>
        <div class="col-md-8">
          <label for="forProProducto">Producto (<span id="spanTipo"></span>): (*)</label>
          <select class="form-control" id="forProProducto"></select>
        </div>
        <div class="col-md-4">
          <label for="forProCantidad">Cantidad <span id="spanUMedida">()</span>: (*)</label>
          <input type="number" class="form-control" id="forProCantidad">
        </div>
        <div class="col-md-6">
          <label for="forProNoControl"># Control / Inventario: (*)</label>
          <input type="text" class="form-control" id="forProNoControl" value="0" maxlength="20">
        </div>
        <div class="col-md-6">
          <label for="forProNoSerie">No. de Serie:</label>
          <input type="text" class="form-control" id="forProNoSerie" maxlength="20">
        </div>
        <div class="col-md-6">
          <label for="forProMarca">Marca:</label>
          <input type="text" class="form-control" id="forProMarca" maxlength="20">
        </div>
        <div class="col-md-6">
          <label for="forProModelo">Modelo:</label>
          <input type="text" class="form-control" id="forProModelo" maxlength="20">
        </div>
        <div class="col-md-6">
          <label for="forProObs">Observaciones:</label>
          <textarea class="form-control" id="forProObs"></textarea>
        </div>
        <div class="col-md-6">
          <label for="forProUbicacion">Ubicación:</label>
          <textarea class="form-control" id="forProUbicacion"></textarea>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 text-center">
          <button type="button" id="btnProCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
        </div>
        <div class="col-sm-6 text-center">
          <button type="button" id="btnProAceptar" class="btn btn-block btnAction btnAcept">AÑADIR</button>
        </div>
      </div>
    </form>
  </div>

  <!--  /////////////////////////// DIV DETALLES DE LA ENTRADA ////////////////////////////////// -->
  <div class="col-md-10 offset-md-1 divForm" id="divLisProductos">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/entradas/prodIcon.png)">
          Detalles de la Entrada
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 divClose text-right">
        <button type="button" class="closeWindow" id="btnCloLisPro"><i class="fas fa-times fa-2x"></i></button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" id="bloLisEntEspecificas">

      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV ELIMINA ENTRADA  ////////////////////////////////// -->
  <div class="col-md-4 offset-md-4 divForm" id="divForDelEntrada">
    <div class="row">
      <div class="col-md-12 titulo">
          ELIMINAR ENTRADA ?
      </div>
    </div>

    <form id="formDelEntrada">
      <input type="hidden" id="forDelEntDel">
    </form>

    <div class="row">
      <div class="col-sm-6 text-center">
        <button type="button" id="btnDelCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
      </div>
      <div class="col-sm-6 text-center">
        <button type="button" id="btnDelAceptar" class="btn btn-block btnAction btnAcept">ELIMINAR</button>
      </div>
    </div>
  </div>
@STOP

@SECTION('script')
  <script type="text/javascript">
    $(document).ready(function(){
      //---------------------------------------------------
      //              VARIABLES GLOBALES
      var prodList = new Array();   //contiene la lista de productos que se guardaran en la entrada que se esta capturando
      var gListaCategorias = new Array();
      var gListaProductos = new Array();
      var gListaEntradas = new Array();

      //--convierte todos los inputs a mayusculas
      $('input, textarea').keyup(function() {
        this.value = this.value.toUpperCase();
      });

      //---------------------------------------------------
      //              CONDICIONES INICIALES
      $(".fondoTransparencia, .fondoTransparencia2, .aviso, .divForm").hide();
      pintaEntradas();
      $('[data-toggle="tooltip"]').tooltip();
      filForLineas();   // reellena la lista de lineas del sub Formulario -> añadir producto
      filForCategorias();   // reellena la lista de categorias del sub Formulario -> añadir producto
      filForProductos();   // reellena la lista de prodcutos del sub Formulario -> añadir producto

      //---------------------------------------------------
      //                ACCIONES DEL DOM
      $(".addButton").click(function(){
        switch ($(this).attr("id")) {
          case 'addEntrada':
            $(".fondoTransparencia, #divForEntrada").show(500);
            pintaLista();
          break;

          case 'addProducto':
            $(".fondoTransparencia2, #divForProducto").show(500);
          break;
        }
      });

      $(".btnAcept").click(function(){
        switch ($(this).attr('id')) {
          case 'btnProAceptar':
            valForProducto();
          break;

          case 'btnEntAceptar':
            valForEntrada('add');
          break;

          case 'btnDelAceptar':
            eliminaEntrada( $("#forDelEntDel").val() );
            $("#divForDelEntrada, .fondoTransparencia").hide();
          break;

          case 'btnEdiEntAceptar':
            valForEntrada('edi');
          break;
        }
      });

      $(".btnCancel, .closeWindow").click(function(){
        switch ($(this).attr("id")) {
          case 'btnEntCancelar':
            $(".fondoTransparencia, #divForEntrada").hide();
            $('#formEntrada')[0].reset();
            prodList = [];
          break;

          case 'btnProCancelar':
            $(".fondoTransparencia2, #divForProducto").hide();
            $('#formProducto')[0].reset();
          break;

          case 'btnCloLisPro':
            $("#divLisProductos, .fondoTransparencia").hide()
          break;

          case 'btnDelCancelar':
            $("#divForDelEntrada, .fondoTransparencia").hide();
          break;

          case 'btnEdiEntCancelar':
            $(".fondoTransparencia, #divForEdiEntrada").hide();
            $("#formEdiEntrada")[0].reset();
            prodList = [];
          break;
        }
      });

      $("#forProLinea").change(function(){
        filForCategorias( $(this).val() );
      });

      $("#forProCategoria").change(function(){
        filForProductos( $(this).val() );
        testForCategoria( $(this).val() );
      });

      $("#bodAddProd, #bodEdiProd").on("click", ".quitaProd", function(){    //-- quita productos de la lista de agregar entrada
        prodList.splice( $(this).attr('id') ,1 );
        pintaLista();
      })

      $("#bloLisEntradas").on("click", ".delEntrada", function(){ //-- pregunta al usuario si desea eliminar entrada
        $("#forDelEntDel").val( $(this).attr('id') );
        $("#divForDelEntrada, .fondoTransparencia").show(500);
      })

      $("#bloLisEntradas").on("click", ".plusInfo", function(){  //-- muestra la información completa de la entrada
        pintaLisEntEspecifica( $(this).attr('id') );
        $("#divLisProductos, .fondoTransparencia").show(500)
      });

      $("#bloLisEntradas").on('click', '.showList', function(){   //-- muestra u oculta la tabla con la lista de productos de la entrada
        if( $("#listProdTable-"+ $(this).attr('data') ).attr('status') == 'hidden' ){
          $("#listProdTable-"+ $(this).attr('data') ).show();
          $("#listProdTable-"+ $(this).attr('data') ).attr('status', 'showed');
        } else if( $("#listProdTable-"+ $(this).attr('data') ).attr('status') == 'showed' ){
          $("#listProdTable-"+ $(this).attr('data') ).hide()
          $("#listProdTable-"+ $(this).attr('data') ).attr('status', 'hidden');
        }
      });

      $("#bloLisEntradas").on('click', '.ediEntrada', function(){   //-- muestra form para editar entrada
        //cargamos los datos al formulario
        for(var x=0; x<gListaEntradas.length; x++){
          if(gListaEntradas[x]['id'] == $(this).attr('id')){
            $("#forEdiEntId").val( $(this).attr('id') );
            $("#forEdiEntFolioFactura").val( gListaEntradas[x]['folioFactura'] );
            $("#forEdiEntFechaIngreso").val( gListaEntradas[x]['fechaIngreso'] );
            $("#forEdiEntObs").val( gListaEntradas[x]['obs'] );
            $("#forEdiEntFechaFactura").val( gListaEntradas[x]['fechaFactura'] );
            $("#forEdiEntMonto").val( gListaEntradas[x]['monto'] );

            for(var y=0; y<(gListaEntradas[x]['listaEntrada']).length; y++){
              prodList[y] = {};
              prodList[y].linea = gListaEntradas[x]['listaEntrada'][y]['linea'];
              prodList[y].categoria = gListaEntradas[x]['listaEntrada'][y]['categoria'];
              prodList[y].producto = gListaEntradas[x]['listaEntrada'][y]['producto'];
              prodList[y].nomProducto = gListaEntradas[x]['listaEntrada'][y]['nomProducto'];
              prodList[y].noControl = gListaEntradas[x]['listaEntrada'][y]['noControl'];
              prodList[y].cantidad = gListaEntradas[x]['listaEntrada'][y]['cantidad'];
              prodList[y].noSerie = gListaEntradas[x]['listaEntrada'][y]['noSerie'];
              prodList[y].marca = gListaEntradas[x]['listaEntrada'][y]['marca'];
              prodList[y].modelo = gListaEntradas[x]['listaEntrada'][y]['modelo'];
              prodList[y].obs = gListaEntradas[x]['listaEntrada'][y]['listaObs'];
              prodList[y].ubicacion = gListaEntradas[x]['listaEntrada'][y]['ubicacion'];
            }
          }
        }
        pintaLista();
        $(".fondoTransparencia, #divForEdiEntrada").show(500);
      });

      //---------------------------------------------------
      //                FUNCIONES GENERALES
      function muestraAviso(tipo, mensaje, time=3000) {
        if(tipo == 'success'){ $(".aviso").addClass('success') }
        $(".aviso").html(mensaje);
        $(".aviso").show(500);
        setTimeout( function(){
          $(".aviso").hide();
          $(".aviso").removeClass('success');
          //$(".fondoTransparencia").hide();
        } ,time);
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

      //--  Valida los campos del Form PRODUCTO
      function valForProducto(){
        if( $("#forProLinea").val() != '' ){
          if( $("#forProCategoria").val() != '' ){
            if( $("#forProProducto").val() != '' ){
              if( $("#noControl").val() != ''){
                if( $("#forProCantidad").val() != '' ){

                  canProdBeAdd();

                } else {
                  muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Cantidad');
                  $("#forProCantidad").focus();
                }
              } else {
                muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el no. de Control');
                $("#noControl").focus();
              }
            } else {
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Producto');
              $("#forProProducto").focus();
            }
          } else {
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
            $("#forProCategoria").focus();
          }
        } else {
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
          $("#forProLinea").focus();
        }
      }

      //-- Valida los campos del Form ENTRADA
      function valForEntrada(origen){
        if( prodList.length != 0 ){
          if( $("#for"+((origen=='edi')?"Edi":"")+"EntFolioFactura").val() != '' ){
            if( $("#for"+((origen=='edi')?"Edi":"")+"EntFechaFactura").val() != '' ){
              if( $("#for"+((origen=='edi')?"Edi":"")+"EntFechaIngreso").val() != '' ){
                if( $("#for"+((origen=='edi')?"Edi":"")+"EntMonto").val() != '' ){
                  if( origen == 'add' ){
                    addEntrada();
                  } else if( origen == 'edi'){
                    ediEntrada();
                  }
                } else {
                  muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el monto de la factura');
                  $("#forEntMonto").focus();
                }
              } else {
                muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la fecha de ingreso');
                $("#forEntFechaIngreso").focus();
              }
            } else {
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la fecha de la factura');
              $("#forEntFechaFactura").focus();
            }
          } else {
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el folio de la factura');
            $("#forEntFolioFactura").focus();
          }
        } else {
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta agregar Productos en la lista');
        }
      }

      //--  pinta la lista de items de la entrada
      function pintaLista(){
        var thisPrint = '';
        for( var x=0; x<prodList.length; x++){
          thisPrint += '<tr>'+
                          '<td>'+prodList[x]['nomProducto']+'</td>'+
                          '<td>'+prodList[x]['cantidad']+'</td>'+
                          '<td>'+prodList[x]['noControl']+'</td>'+
                          '<td><button class="quitaProd pseudoBtn" id="'+x+'"><i class="far fa-trash-alt fa-lg"></i></button></td>'+
                       '</tr>';
        }
        $("#bodAddProd, #bodEdiProd").html(thisPrint);
      }

      //---------------------------------------------------
      //                  FUNCIONES AJAX
      //-- funciones del form
      //-- llena el form con las lineas
      function filForLineas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/entradas/getLineas') }}"
        })
        .done(function(data){
          console.log('filForLineas("ok")');
          var lista = '<option value="">-- Seleccionar Linea --</option>'
          if(data != 'empty'){
            data = $.parseJSON(data);
            for(var x=0; x<data.length; x++){
              if(data[x]['activo'] == 1){
                lista += '<option value="'+data[x]['id']+'">'+data[x]['linea']+'</option>';
              }
            }
          } else {
            lista = '<option value="">-- Lista Vacía --</option>'
          }
          $("#forProLinea").html(lista);
        })
        .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('filForLineas("falló")');
        });
      }

      //-- llena el "subform - añadir producto" con las categorias
      function filForCategorias(id){
        if(id == undefined){
          $.ajax({
              data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/entradas/getCategorias') }}"
          })
          .done(function(data){
            console.log('filForCategorias("ok")');
            if(data != 'empty'){
              data = $.parseJSON(data);
              gListaCategorias = data;
            }
          })
          .fail(function(){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
              console.log('filForCategorias("falló")');
          });
        } else {
          if(gListaCategorias != 'empty'){
            var lista = '<option value="">-- Seleccionar Categoria --</option>';
            for(var x=0; x<gListaCategorias.length; x++){
              if(gListaCategorias[x]['activo'] == 1 && gListaCategorias[x]['noLinea'] == id){
                if(gListaCategorias[x]['noLinea'] == id){
                 lista += '<option value="'+gListaCategorias[x]['id']+'">'+gListaCategorias[x]['categoria']+'</option>';
                }
              }
            }
          } else {
            var lista = '<option value="">-- Lista Vacía --</option>'
          }
          $("#forProCategoria").html(lista);
        }
      }

      //-- llena el form con los productos
      function filForProductos(id){
        if(id == undefined){
          $.ajax({
              data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/entradas/getProductos') }}"
          })
          .done(function(data){
              console.log('filForProductos("ok")');
              if(data != 'empty'){
                  gListaProductos = $.parseJSON(data);
              }
          })
          .fail(function(){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
              console.log('filForProductos("falló")');
          });
        } else {
          if( gListaProductos != null ){
            var lista = '<option value="">-- Seleccionar Producto --</option>';

            for(var x=0; x<gListaProductos.length; x++){
              if(gListaProductos[x]['activo'] == 1 && gListaProductos[x]['noCategoria'] == id){
                 lista += '<option value="'+gListaProductos[x]['id']+'">'+gListaProductos[x]['producto']+'</option>';
              }
            }
          } else {
            var lista = '<option value="">-- Lista Vacía --</option>'
          }
          $("#forProProducto").html(lista);
        }
      }

      //-- prueba la categoria seleccionada para autorellenar el numero de control  inventario
      function testForCategoria(id){
        for(var x=0; x<gListaCategorias.length; x++){
          if(gListaCategorias[x]['id'] == id){
            $("#spanUMedida").html( "("+gListaCategorias[x]['uMedida']+")" );
            $("#spanTipo").html(gListaCategorias[x]['tipo']);
            if(gListaCategorias[x]['tipo'] == 'CON' || gListaCategorias[x]['tipo'] == 'BIN'){
              $("#forProNoControl").val(0);
              $("#forProCantidad").val(1);
              readonly('#forProNoControl, text', true);
              readonly('#forProNoSerie, text', true);
              readonly('#forProMarca, text', true);
              readonly('#forProModelo, text', true);
              readonly('#forProObs, text', true);
              readonly('#forProUbicacion, text', true);
              readonly('#forProCantidad, text', false);
            } else if(gListaCategorias[x]['tipo'] == 'BII'){
              $("#forProCantidad").val(1);
              readonly('#forProNoControl, text', false);
              readonly('#forProNoSerie, text', false);
              readonly('#forProMarca, text', false);
              readonly('#forProModelo, text', false);
              readonly('#forProObs, text', false);
              readonly('#forProUbicacion, text', false);
              readonly('#forProCantidad, text', true);
            }
          }
        }
      }

      //-- guarda datos de la entrada en la DB
      function addEntrada(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", tipo:'ent', folioFactura: $("#forEntFolioFactura").val(),
                    fechaFactura: $("#forEntFechaFactura").val(), fechaIngreso: $("#forEntFechaIngreso").val(),
                    monto: $("#forEntMonto").val(), obs: $("#forEntObs").val(),
                    listaEntradas: JSON.stringify(prodList), anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/entradas/addEntrada') }}",
            error: function(data)
                {
                    var errors = '';
                    for(datos in data.responseJSON){
                        errors += data.responseJSON[datos] + '<br>';
                    }
                    console.log(errors); //this is my div with messages
                }
        })
        .done(function(data){
          console.log('addEntrada("ok")');
          muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Entrada registrada exitosamente');
          $(".fondoTransparencia, #divForEntrada").hide();
          $('#formEntrada')[0].reset();
          prodList = [];
          pintaEntradas();
        })
        .fail(function(){
          console.log('addEntrada("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- guarda datos de la entrada en la DB
      function ediEntrada(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id:$("#forEdiEntId").val(), tipo:'ent', folioFactura: $("#forEdiEntFolioFactura").val(),
                    fechaFactura: $("#forEdiEntFechaFactura").val(), fechaIngreso: $("#forEdiEntFechaIngreso").val(),
                    monto: $("#forEdiEntMonto").val(), obs: $("#forEdiEntObs").val(),
                    listaEntradas: JSON.stringify(prodList), anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/entradas/ediEntrada') }}",
            error: function(data)
                {
                    var errors = '';
                    for(datos in data.responseJSON){
                        errors += data.responseJSON[datos] + '<br>';
                    }
                    console.log(errors); //this is my div with messages
                }
        })
        .done(function(data){
          console.log(data);
          if(data == 'ok'){
            console.log('ediEntrada("ok")');
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Entrada modificada exitosamente');
            $(".divForm, .fondoTransparencia").hide();
            $("#formEdiEntrada")[0].reset();
            prodList = [];
            pintaEntradas();
          } else {
            console.log('ediEntrada("alertas")');
            data = $.parseJSON(data);
            mensaje = '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i><br>';
            for(var x=0; x<data.length; x++){
              mensaje += '- '+data[x]+'<br><br>';
            }
            time = data.length * 5000;
            muestraAviso('', mensaje, time);
          }
        })
        .fail(function(){
          console.log('ediEntrada("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- pinta las entradas en una tabla
      function pintaEntradas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/entradas/getEntradas') }}"
        })
        .done(function(data){
          console.log('pintaEntradas("ok")');
          //console.log(data);
          var lista = '<table class="table table-sm tabLisEntradas">'+
                        '<thead>'+
                          //'<tr>'+
                            '<th>#</th>'+
                            '<th>Fecha de la Entrada</th>'+
                            '<th>Folio de la Factura</th>'+
                            '<th>Monto</td>'+
                            '<th>Observaciones</th>'+
                            '<th>Lista de Productos</th>'+
                          //'<tr>'+
                        '</thead>'+
                        '<tbody>';
          if(data != 'empty'){
            data = $.parseJSON(data);
            gListaEntradas = data;
            for(var x=0; x<data.length; x++){
              lista += '<tr>'+
                         '<td>'+data[x]['id']+'</td>'+
                         '<td>'+data[x]['fechaIngreso']+'</td>'+
                         '<td>'+data[x]['folioFactura']+'</td>'+
                         '<td>$'+data[x]['monto']+'</td>'+
                         '<td>'+data[x]['obs']+'</td>'+
                         '<td>'+
                          '<button class="showList" data="'+data[x]['id']+'"><i class="fas fa-list-ul fa-lg"></i></button>'+
                          '<table  class="listProdTable" id="listProdTable-'+data[x]['id']+'" status="hidden">'+
                            '<thead> <td>#</td> <td>Producto</td> <td>Cantidad</td> </thead>';

                for(var y=0; y<(data[x]['listaEntrada']).length; y++){
                  lista += '<tr>'+
                              '<td>'+(y+1)+'</td>'+
                              '<td>'+data[x]['listaEntrada'][y]['nomProducto']+'</td>'+
                              '<td>'+data[x]['listaEntrada'][y]['cantidad']+' '+data[x]['listaEntrada'][y]['uMedida']+'.</td>'+
                            '</tr>'
                }

                lista+= ''+
                            '<tr><td colspan="3">'+
                                '<button class="taskBtn plusInfo" id="'+data[x]['id']+'"> <i class="fas fa-plus fa-lg"></i> &nbsp; Info. </button>'+
                            '</td></tr>'+
                            '<tr><td colspan="3">'+
                                '<button class="taskBtn ediEntrada" id="'+data[x]['id']+'"> <i class="fas fa-pencil-alt fa-lg"></i> &nbsp; Modificar </button>'+
                            '</td></tr>'+
                            '<tr><td colspan="3">'+
                                '<button class="taskBtn delEntrada" id="'+data[x]['id']+'"> <i class="far fa-trash-alt fa-lg"></i> &nbsp; Eliminar </button>'+
                            '</td></tr>'+
                           '</table>'+
                         '</td>'+
                        '</tr>';
            }
            lista +='</tbody>'+
                  '</table>';
          } else {
            lista = 'Lista de Entradas vacía'
          }
          $("#bloLisEntradas").html(lista);
          $(".listProdTable").hide();
          $("#listProdTable-1").hide();
          $('.tabLisEntradas').DataTable({
            "order": [[ 0, "desc" ]],
						"retrieve": true,
						"language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
						"paging": false,
						"info": false

					});
        })
        .fail(function(){
          console.log('pintaEntradas("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- pinta la lista de entradas especifica
      function pintaLisEntEspecifica(id){
        console.log('pintaLisEntEspecifica("ok")');
        for( var x=0; x<gListaEntradas.length; x++){
          if( gListaEntradas[x]['id'] == id ){
            var lista = ''+
              '<div class="row">'+
                '<div class="col-md-8">'+
                  '<div class="row">'+
                    '<div class="col-md-4 textBold"> # </div>'+
                    '<div class="col-md-4 textBold"> Fecha de la Entrada: </div>'+
                    '<div class="col-md-4 textBold"> Tipo: </div>'+

                    '<div class="col-md-4 textAnswere">'+gListaEntradas[x]['id']+'</div>'+
                    '<div class="col-md-4 textAnswere">'+gListaEntradas[x]['fechaIngreso']+'</div>'+
                    '<div class="col-md-4 textAnswere">ENTRADA</div>'+

                    '<div class="col-md-4 textBold"> Folio de la Factura: </div>'+
                    '<div class="col-md-4 textBold"> Fecha de la Factura: </div>'+
                    '<div class="col-md-4 textBold"> Monto de la Factura: </div>'+

                    '<div class="col-md-4 textAnswere">'+gListaEntradas[x]['folioFactura']+'</div>'+
                    '<div class="col-md-4 textAnswere">'+gListaEntradas[x]['fechaFactura']+'</div>'+
                    '<div class="col-md-4 textAnswere">'+gListaEntradas[x]['monto']+'</div>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="row">'+
                    '<div class="col-md-12 textBold">Observaciones:</div>'+
                    '<div class="col-md-12 textAnswere">'+gListaEntradas[x]['obs']+'</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="row">';

              lista += ''+
              '<table class="table table-sm" id="tabLista">'+
                '<thead>'+
                  '<tr>'+
                    '<th>#</th>'+
                    '<th>Producto</th>'+
                    '<th>Categoría</th>'+
                    '<th>Linea</th>'+
                    '<th># Control</th>'+
                    '<th># Serie</th>'+
                    '<th>Marca</th>'+
                    '<th>Modelo</th>'+
                    '<th>Ubicación</th>'+
                    '<th>Obs</th>'+
                    '<th>Cantidad</th>'+
                  '<tr>'+
                '</thead>'+
                '<tbody>';

                for(var y=0; y<(gListaEntradas[x]['listaEntrada']).length; y++){
                    lista += '<tr>'+
                               '<td>'+(y+1)+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['nomProducto']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['nomCategoria']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['nomLinea']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['noControl']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['noSerie']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['marca']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['modelo']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['ubicacion']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['listaObs']+'</td>'+
                               '<td>'+gListaEntradas[x]['listaEntrada'][y]['cantidad']+' '+gListaEntradas[x]['listaEntrada'][y]['uMedida']+'.</td>'+
                             '</tr>';
                }
                lista +='</tbody>'+
                      '</table>';
                /*} else {
                  lista = 'Lista de Entradas vacía'
                }*/


              lista += ''+
              '</div>';

            $("#bloLisEntEspecificas").html(lista);
          }
        }
      }

      //-- elimina entrada de la DB
      function eliminaEntrada(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id, anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/entradas/delEntrada') }}"
        })
        .done(function(data){
          if(data == 'ok'){
            console.log('eliminaEntrada("ok")');
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Entrada eliminada exitosamente');
            $(".divForm").hide();
            pintaEntradas();
          } else {
            console.log('eliminaEntrada("alertas")');
            data = $.parseJSON(data);
            mensaje = '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i><br>';
            for(var x=0; x<data.length; x++){
              mensaje += '- '+data[x]+'<br><br>';
            }
            time = data.length * 5000;
            muestraAviso('', mensaje, time);
          }
        })
        .fail(function(){
          console.log('eliminaEntrada("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- prueba si el producto puede ser agregado a la lista (evita duplicidad de noControl)
      function canProdBeAdd(){
        $.ajax({
          data: { "_token": "{{ csrf_token() }}", categoria: $("#forProCategoria").val(),
                  producto: $("#forProProducto").val(), noControl: $("#forProNoControl").val(),
                  anio:{{Session('anio')}}},
          type: "POST",
          url: "{{ url('../api/almacen/entradas/canProdBeAdd') }}"
        }).done(function(data){
          console.log('canProdBeAdd('+data+')');

          //console.log(prodList);
          var flag = 0;
          for(var x=0; x<prodList.length; x++){
            if( prodList[x]['producto'] == $("#forProProducto").val()  &&  prodList[x]['noControl'] == $("#forProNoControl").val() ){
              flag = 1;
              break;
            }
          }

          if(data == 'ok' && flag == 0){
            var thisNo = prodList.length;
            prodList[ thisNo ] = {};
            prodList[ thisNo ].linea = $("#forProLinea").val();
            prodList[ thisNo ].categoria = $("#forProCategoria").val();
            prodList[ thisNo ].producto = $("#forProProducto").val();
            prodList[ thisNo ].nomProducto = $("#forProProducto option:selected").text();
            prodList[ thisNo ].noControl = $("#forProNoControl").val();
            prodList[ thisNo ].cantidad = $("#forProCantidad").val();
            prodList[ thisNo ].noSerie = $("#forProNoSerie").val();
            prodList[ thisNo ].marca = $("#forProMarca").val();
            prodList[ thisNo ].modelo = $("#forProModelo").val();
            prodList[ thisNo ].obs = $("#forProObs").val();
            prodList[ thisNo ].ubicacion = $("#forProUbicacion").val();
            pintaLista();
            $(".fondoTransparencia2, #divForProducto").hide();
            $('#formProducto')[0].reset();
          } else {
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; El # de control '+$("#forProNoControl").val()+' ya existe para este producto');
          }
        }).fail(function(){
          console.log('canProdBeAdd("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }
    });
  </script>
@STOP
