@EXTENDS('almacen.layouts.masterAlmacen')

@SECTION('title')
  Almacen - Salidas
@STOP

@SECTION('moreStyles')
  <script src="{{asset('../js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('../js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('../js/readOnly.js')}}"></script>
  <link rel="stylesheet" href="{{asset('../css/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/almacen/salidas.css')}}">
@STOP

@SECTION('content')

  <!--  /////////////////////////// DIV TRANSPARENCIA ////////////////////////// -->
  <div class="fondoTransparencia"></div>
  <div class="fondoTransparencia2"></div>
  <div class="fondoTransparencia3"></div>

  <!--  /////////////////////////// DIV AVISO ////////////////////////////////// -->
  <div class="col-md-4 offset-md-4 aviso text-center"></div>

  <!--  /////////////////////////// DIV MAIN ////////////////////////////////// -->
  <div class="col-md-12 main-div">
    <div class="row">
      <div class="col-md-9">
        <div class="subTitle text-center">
          LISTA DE SALIDAS
        </div>
      </div>
      <div class="col-md-3">
        <button type="button" id="addSalida" class="addButton">NUEVA SALIDA &nbsp;&nbsp; <i class="far fa-plus-square fa-lg" aria-hidden="true"></i></button>
      </div>
    </div>

    <div class="row noPadd divLisEntradas">
      <div class="col-md-12 table-responsive" id="bloLisSalidas">

      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV FORM ADDSALIDA ////////////////////////////////// -->
  <div class="col-md-6 offset-md-3 divForm" id="divForSalida">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/salidas/salidaIcon.png)">
          NUEVA SALIDA
      </div>
    </div>
    <form id="formSalida">
      <div class="row">
        <div class="col-md-12">
          <label for="forSalNomSol">Nombre del Solicitante:</label>
          <input type="text" id="forSalNomSol" class="form-control" maxlength="100"><br>
        </div>

        <div class="col-md-12">
          <label for="forSalArea">Area:</label>
          <select id="forSalArea" class="form-control"></select><br>
        </div>

        <div class="col-md-6">
          <label for="forSalFechaSalida">Fecha de Salida:</label>
          <input type="date" id="forSalFechaSalida" class="form-control fecha"><br>
          <label for="forSalDestino">Destino:</label>
          <textarea id="forSalDestino" class="form-control"></textarea>
        </div>

        <div class="col-md-6">
          <label for="forSalFechaDev">Fecha de Devolución:</label>
          <input type="date" id="forSalFechaDev" class="form-control fecha"><br>
          <label for="forSalObs">Observaciones</label>
          <textarea id="forSalObs" class="form-control"></textarea>
        </div>

        <div class="col-md-12"><br>
          <button type="button" id="addProducto" class="addButton">AÑADIR PRODUCTO &nbsp;&nbsp;<i class="far fa-plus-square fa-lg" aria-hidden="true"></i></button>
        </div>

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
        <button type="button" id="btnSalCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
      </div>
      <div class="col-sm-6 text-center">
        <button type="button" id="btnSalAceptar" class="btn btn-block btnAction btnAcept">AGREGAR</button>
      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV FORM ADDP RODUCTO  ////////////////////////////////// -->
  <div class="col-md-6 offset-md-3 divForm" id="divForProducto">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/salidas/prodIcon.png)">
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
        <div class="col-md-6">
          <label for="forProProducto">Producto (<span id="spanTipo"></span>): (*)</label>
          <select class="form-control" id="forProProducto"></select>
        </div>
        <div class="col-md-6">
          <label for="forProCantidad">Cantidad <span id="spanUMedida">()</span>: (*)</label> Disponibles: <span id="spanDisponibles" style="color:#00f">0</span>
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
    </form>
      <div class="row">
        <div class="col-sm-6 text-center">
          <button type="button" id="btnProCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
        </div>
        <div class="col-sm-6 text-center">
          <button type="button" id="btnProAceptar" class="btn btn-block btnAction btnAcept">AÑADIR</button>
        </div>
      </div>
  </div>

  <!--  /////////////////////////// DIV FORM EDISALIDA ////////////////////////////////// -->
  <div class="col-md-6 offset-md-3 divForm" id="divForEdiSalida">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/salidas/salidaIcon.png)">
          MODIFICAR SALIDA
      </div>
    </div>
    <form id="formEdiSalida">
      <div class="row">
        <div class="col-md-12">
          <input type="hidden" id="forEdiSalId">
          <label for="forEdiSalNomSol">Nombre del Solicitante:</label>
          <input type="text" id="forEdiSalNomSol" class="form-control" maxlength="100"><br>
        </div>

        <div class="col-md-12">
          <label for="forEdiSalArea">Area:</label>
          <select id="forEdiSalArea" class="form-control"></select><br>
        </div>

        <div class="col-md-6">
          <label for="forEdiSalFechaSalida">Fecha de Salida:</label>
          <input type="date" id="forEdiSalFechaSalida" class="form-control fecha"><br>
          <label for="forEdiSalDestino">Destino:</label>
          <textarea id="forEdiSalDestino" class="form-control"></textarea>
        </div>

        <div class="col-md-6">
          <label for="forEdiSalFechaDev">Fecha de Devolución:</label>
          <input type="date" id="forEdiSalFechaDev" class="form-control fecha"><br>
          <label for="forEdiSalObs">Observaciones</label>
          <textarea id="forEdiSalObs" class="form-control"></textarea>
        </div>

        <div class="col-md-12"><br>
          <button type="button" id="addProducto" class="addButton">AÑADIR PRODUCTO &nbsp;&nbsp;<i class="far fa-plus-square fa-lg" aria-hidden="true"></i></button>
        </div>

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
        <button type="button" id="btnEdiSalCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
      </div>
      <div class="col-sm-6 text-center">
        <button type="button" id="btnEdiSalAceptar" class="btn btn-block btnAction btnAcept">MODIFICAR</button>
      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV DETALLES DE LA SALIDA ////////////////////////////////// -->
  <div class="col-md-10 offset-md-1 divForm" id="divLisProductos">
    <div class="row">
      <div class="col-md-12 titulo" style="background-image:url(../img/almacen/entradas/prodIcon.png)">
          Detalles de la Salida
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 divClose text-right">
        <button type="button" class="closeWindow" id="btnCloLisPro"><i class="fas fa-times fa-lg"></i></button>
      </div>
    </div>


    <div class="col-md-12" id="bloLisSalEspecificas">

    </div>
  </div>

  <!--  /////////////////////////// DIV FORM ADDP sUBsTOCK  ////////////////////////////////// -->
  <div class="col-md-8 offset-md-2 text-center divForm" id="divForStock">
    <div class="row" id="divForStockHead">
      <div class="col-md-11"> Seleccione el producto específico que desea prestar </div>
      <div class="col-md-1 text-right" id="divForStockHead">
        <button type="button" class="pseudoBtn closeWindow" id="closeSubStock"> <i class="fas fa-times fa-lg"></i> </button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        "<span id="prodSelected"> este producto. </span>"<br>
        <table class="table table-sm" id="tabSubStock">
          <thead>
            <tr>
              <th># DE CONTROL</th>
              <th>Disponible</th>
              <th>Comisionado a</th>
            </tr>
          </thead>
          <tbody id="tabForSubStockAct">

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--  /////////////////////////// DIV ELIMINA SALIDA  ////////////////////////////////// -->
  <div class="col-md-4 offset-md-4 divForm" id="divForDelSalida">
    <div class="row">
      <div class="col-md-12 titulo">
          ELIMINAR SALIDA ?
      </div>
    </div>
    <form id="formDelSalida">
      <input type="hidden" id="forDelSalDel">
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
      var gListaLineas = new Array();
      var gListaCategorias = new Array();
      var gListaProductos = new Array();
      var gListaSalidas = new Array();
      var gProductoTemporal = new Array();
      var isDevNeed = 0;

      //pintaSalidas();
      $('[data-toggle="tooltip"]').tooltip();
      readonly('#forProNoControl, text', true);

      //---------------------------------------------------
      //              CONDICIONES INICIALES
      $(".fondoTransparencia, .fondoTransparencia2, .fondoTransparencia3, .aviso, .divForm").hide();
      pintaSalidas();
      getListaAreas();
      filForLineas();   // reellena la lista de lineas del sub Formulario -> añadir producto
      filForCategorias();   // reellena la lista de categorias del sub Formulario -> añadir producto
      filForProductos();   // reellena la lista de prodcutos del sub Formulario -> añadir producto
        //bloqueamos los campos del form donde se añaden productos a la lista
      readonly('#forProNoControl, text', true);
      readonly('#forProNoSerie, text', true);
      readonly('#forProMarca, text', true);
      readonly('#forProModelo, text', true);
      readonly('#forProObs, text', true);
      readonly('#forProUbicacion, text', true);

      //--convierte todos los inputs a mayusculas
      $('input, textarea').keyup(function() {
        this.value = this.value.toUpperCase();
      });

      //---------------------------------------------------
      //                ACCIONES DEL DOM
      $(".addButton").click(function(){
        switch ($(this).attr("id")) {
          case 'addSalida':
            $(".fondoTransparencia, #divForSalida").show(500);
            readonly('#forSalFechaDev, date', true);
            $("#forSalFechaDev").val("");
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

          case 'btnSalAceptar':
            valForSalida( 'add' );
          break;

          case 'btnDelAceptar':
            eliminaSalida( $("#forDelSalDel").val() );
            $("#divForSalEntrada, .fondoTransparencia").hide();
          break;

          case 'btnEdiSalAceptar':
            valForSalida( 'edi' );
          break;
        }
      });

      $(".btnCancel, .closeWindow").click(function(){
        switch ($(this).attr("id")) {
          case 'btnSalCancelar':
            $(".fondoTransparencia, #divForSalida").hide();
            $('#formSalida')[0].reset();
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
            $("#divForDelSalida, .fondoTransparencia").hide();
          break;

          case 'closeSubStock':
            $(".fondoTransparencia3, #divForStock").hide();
            $("#forProNoControl").val(0);
          break;

          case 'btnEdiSalCancelar':
            $(".fondoTransparencia, #divForEdiSalida").hide();
            $("#formEdiSalida")[0].reset();
            prodList = [];
          break;
        }
      });

      $("#bodAddProd, #bodEdiProd").on("click", ".quitaProd", function(){
        prodList.splice( $(this).attr('id') ,1 );
        pintaLista();
      })

      $("#forProLinea").change(function(){
        filForCategorias( $(this).val() );
        $("#forProCategoria, #forProProducto").val("");
        $("#spanTipo").html("");
        $("#forProNoSerie").val("");
        $("#forProMarca").val("");
        $("#forProModelo").val("");
        $("#forProObs").val("");
        $("#forProUbicacion").val("");
      });

      $("#forProCategoria").change(function(){
        filForProductos( $(this).val() );
        testCategoria( $(this).val() );
        $("#forProProducto").val("");
        $("#forProNoSerie").val("");
        $("#forProMarca").val("");
        $("#forProModelo").val("");
        $("#forProObs").val("");
        $("#forProUbicacion").val("");
      })

      $("#forProProducto").change(function(){
        testProducto( $(this).val() );
        $("#prodSelected").html( $("#forProProducto option:selected").text() );
      });

      $("#tabForSubStockAct").on('click', '.subStockDisp', function(){
        testNoInvSelected( $(this).attr('meta') );
      });

      //-- botones de accion en la tabla de salidas
      $("#bloLisSalidas").on("click", ".delSalida", function(){
        $("#forDelSalDel").val( $(this).attr('id') );
        $("#divForDelSalida, .fondoTransparencia").show(500);
      })

      $("#bloLisSalidas").on('click', '.showList', function(){   //-- muestra u oculta la tabla con la lista de productos de la entrada
        if( $("#listProdTable-"+ $(this).attr('data') ).attr('status') == 'hidden' ){
          $("#listProdTable-"+ $(this).attr('data') ).show();
          $("#listProdTable-"+ $(this).attr('data') ).attr('status', 'showed');
        } else if( $("#listProdTable-"+ $(this).attr('data') ).attr('status') == 'showed' ){
          $("#listProdTable-"+ $(this).attr('data') ).hide()
          $("#listProdTable-"+ $(this).attr('data') ).attr('status', 'hidden');
        }
      });

      $("#bloLisSalidas").on("click", ".plusInfo", function(){  //-- muestra la información completa de la entrada
        pintaLisSalEspecifica( $(this).attr('id') );
        $("#divLisProductos, .fondoTransparencia").show(500)
      });

      $("#bloLisSalidas").on("click", ".impSalida", function(){
        window.open('/almacen/salImp/'+$(this).attr('id'), '_blank');
        pintaSalidas();     //recarga la lista debido a que se actualiza el status de la salida
      });

      $("#bloLisSalidas").on("click", ".ediSalida", function(){
        //cargamos los datos al formulario
        for(var x=0; x<gListaSalidas.length; x++){
          if(gListaSalidas[x]['id'] == $(this).attr('id')){
            $("#forEdiSalId").val( $(this).attr('id') );
            $("#forEdiSalNomSol").val( gListaSalidas[x]['nomSol'] );
            $("#forEdiSalArea").val( gListaSalidas[x]['noArea'] );
            $("#forEdiSalFechaSalida").val( gListaSalidas[x]['fechaSalida'] );
            $("#forEdiSalFechaDev").val( gListaSalidas[x]['fechaDev'] );
            $("#forEdiSalDestino").val( gListaSalidas[x]['destino'] );
            $("#forEdiSalObs").val( gListaSalidas[x]['obs'] );
            for(var y=0; y<(gListaSalidas[x]['listSalida']).length; y++){
              prodList[y] = {};
              prodList[y].linea = gListaSalidas[x]['listSalida'][y]['linea'];
              prodList[y].categoria = gListaSalidas[x]['listSalida'][y]['categoria'];
              prodList[y].producto = gListaSalidas[x]['listSalida'][y]['producto'];
              prodList[y].nomProducto = gListaSalidas[x]['listSalida'][y]['pro_producto'];
              prodList[y].noControl = gListaSalidas[x]['listSalida'][y]['noControl'];
              prodList[y].cantidad = gListaSalidas[x]['listSalida'][y]['cantidad'];
              prodList[y].noSerie = gListaSalidas[x]['listSalida'][y]['noSerie'];
              prodList[y].marca = gListaSalidas[x]['listSalida'][y]['marca'];
              prodList[y].modelo = gListaSalidas[x]['listSalida'][y]['modelo'];
              prodList[y].obs= gListaSalidas[x]['listSalida'][y]['obs'];
              prodList[y].ubicacion = gListaSalidas[x]['listSalida'][y]['ubicacion'];
              prodList[y].tipo = gListaSalidas[x]['listSalida'][y]['cat_tipo'];
            }
          }
        }
        console.log(prodList)
        pintaLista();
        $(".fondoTransparencia, #divForEdiSalida").show(500);
      });
      //--

      //---------------------------------------------------
      //                FUNCIONES GENERALES
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

      //-- valida los campos del formulario producto
      function valForProducto(){
        if( $("#forProLinea").val() != '' ){
          if( $("#forProCategoria").val() != '' ){
            if( $("#forProProducto").val() != '' ){
              if( $("#noControl").val() != '' ){
                if( $("#forProCantidad").val() != '' || $("#forProCantidad").val() != '0' ){
                  var thisCant = parseFloat($("#forProCantidad").val());
                  var thisDisp = parseFloat($("#spanDisponibles").html());
                  if( thisCant <= thisDisp ){
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
                    prodList[ thisNo ].obs= $("#forProObs").val();
                    prodList[ thisNo ].ubicacion = $("#forProUbicacion").val();
                    prodList[ thisNo ].tipo = $("#spanTipo").html();
                    pintaLista();
                    $('#formProducto')[0].reset();
                    $(".fondoTransparencia2, #divForProducto").hide();
                  } else {
                    muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La cantidad solicitada es mayor a la disponible');
                    $("#forProCantidad").focus();
                  }
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

      //-- Valida los campos del Form SALIDA
      function valForSalida( origen ){
        if( prodList.length != 0 ){
          if( $("#for"+((origen == 'edi')? "Edi" : "")+"SalNomSol").val() != '' ){
            if( $("#for"+((origen == 'edi')? "Edi" : "")+"SalArea").val() != '' ){
              if( $("#for"+((origen == 'edi')? "Edi" : "")+"SalFechaSalida").val() != '' ){
                if( $("#for"+((origen == 'edi')? "Edi" : "")+"SalDestino").val() != '' ){
                  if( isDevNeed == 1 ){
                    if( $("#for"+((origen == 'edi')? "Edi" : "")+"SalFechaDev").val() != '' ){
                      if(origen == 'add'){
                          addSalida();
                      } else if(origen == 'edi'){
                          ediSalida();
                      }
                    } else {
                      muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la fecha de devolución');
                      $("#for"+((origen == 'edi')? "Edi" : "")+"SalFechaDev").focus();
                    }
                  } else if( isDevNeed == 0 ) {
                    $("#for"+((origen == 'edi')? "Edi" : "")+"SalFechaDev").val('');
                    if(origen == 'add'){
                      addSalida();
                    } else if(origen == 'edi'){
                      ediSalida();
                    }
                  }
                } else {
                  muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Destino');
                  $("#for"+((origen == 'edi')? "Edi" : "")+"SalDestino").focus();
                }
              } else {
                muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Fecha de Salida');
                $("#for"+((origen == 'edi')? "Edi" : "")+"SalFechaSalida").focus();
              }
            } else {
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta seleccionar el proyecto');
              $("#for"+((origen == 'edi')? "Edi" : "")+"SalArea").focus();
            }
          } else {
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el nombre');
            $("#for"+((origen == 'edi')? "Edi" : "")+"SalNomSol").focus();
          }
        } else {
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta agregar Productos en la lista');
        }
      }

      //-- pinta la lista de items de la entrada
      function pintaLista(){
        var thisPrint = '';
        for( var x=0; x<prodList.length; x++ ){
          thisPrint += '<tr>'+
                          '<td>'+prodList[x]['nomProducto']+'</td>'+
                          '<td>'+prodList[x]['cantidad']+'</td>'+
                          '<td>'+prodList[x]['noControl']+'</td>'+
                          '<td><i class="far fa-trash-alt fa-lg quitaProd" aria-hidden="true" id="'+x+'"></i></td>'+
                       '</tr>';
        }
        //comprueba si se necesita fecha de devolucion
        for( var x=0; x<prodList.length; x++ ){
          if( prodList[x]['tipo'] == 'BII' || prodList[x]['tipo'] == 'BIN' ){
            isDevNeed = 1;
            readonly('#forSalFechaDev, text', false);
            readonly('#forEdiSalFechaDev, text', false);
            break;
          } else if( prodList[x]['tipo'] == 'CON' ) {
            isDevNeed = 0;
            readonly('#forSalFechaDev, text', true);
            readonly('#forEdiSalFechaDev, text', true);
          }
        }
        $("#bodAddProd, #bodEdiProd").html(thisPrint);
      }

      //-- prueba si no ha sido capturado este prod->noControl antes
      function testNoInvSelected( id ){
        var thisFlag = 0;
        for(var x=0; x<(prodList).length; x++){
          if( prodList[x]['producto'] == $("#forProProducto").val() ){
            if( prodList[x]['noControl'] == id){
              thisFlag = 1;
            }
          }
        }

        if(thisFlag == 0){
          for(var x=0; x < (gProductoTemporal['listaStock']).length; x++){
            if(gProductoTemporal['listaStock'][x]['noControl'] == id){
              $("#forProNoSerie").val( gProductoTemporal['listaStock'][x]['noSerie'] );
              $("#forProMarca").val( gProductoTemporal['listaStock'][x]['marca'] );
              $("#forProModelo").val( gProductoTemporal['listaStock'][x]['modelo'] );
              $("#forProObs").val( gProductoTemporal['listaStock'][x]['obs'] );
              $("#forProUbicacion").val( gProductoTemporal['listaStock'][x]['ubicacion'] );
            }
          }
          $("#forProNoControl").val( id );
          $(".fondoTransparencia3, #divForStock").hide();
          gProductoTemporal = [];
        } else {
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Ya haz agregado este producto a la lista');
        }
      }

      //---------------------------------------------------
      //                  FUNCIONES AJAX
      //-- llena el form con la lista de proyectos
      function getListaAreas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/salidas/getListaAreas') }}"
        })
        .done(function(data){
          console.log('getListaAreas("ok")');
          var lista = '<option value="">-- Seleccionar Área --</option>'+
                      '<option class="selDivision" disabled>----------------</option>';
          data = $.parseJSON(data);

          for(var x=0; x<(data['direcciones']).length; x++){
            lista += '<option class="selDireccion" value="'+data['direcciones'][x]['id']+'">'+data['direcciones'][x]['nombre']+'</option>';
            for(var y=0; y<(data['direcciones'][x]['sub']).length; y++){
              lista += '<option value="'+data['direcciones'][x]['sub'][y]['id']+'">'+data['direcciones'][x]['sub'][y]['nombre']+'</option>';
              //console.log( data['direcciones'][x]['sub'][y] );
            }
            lista += '<option class="selDivision" disabled>----------------</option>';
          }

          $("#forSalArea, #forEdiSalArea").html(lista);
        })
        .fail(function(){
            muestraAviso('', '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('getListaAreas("falló")');
        });
      }

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
            gListaLineas = data;
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

      //-- prueba la categoria['tipo'] modificar form segun necesidades
      function testCategoria(id){
        for(var x=0; x<gListaCategorias.length; x++){
          if(gListaCategorias[x]['id'] == id){
            $("#spanTipo").html(gListaCategorias[x]['tipo']);
            $("#spanUMedida").html( "("+gListaCategorias[x]['uMedida']+")" );
            if(gListaCategorias[x]['tipo'] == 'CON' || gListaCategorias[x]['tipo'] == 'BIN'){
              $("#forProNoControl").val(0);
              $("#forProCantidad").val(1);
              readonly('#forProObs, text', true);
              readonly('#forProCantidad, text', false);
            } else if(gListaCategorias[x]['tipo'] == 'BII'){
              $("#forProCantidad").val(1);
              readonly('#forProObs, text', false);
              readonly('#forProCantidad, text', true);
            }
          }
        }
      }

      //-- prueba producto y rellena subStock List
      function testProducto(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id, anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/salidas/testProdStock') }}"
        })
        .done(function(data){
          console.log('testProducto("ok")');
          if(data != 'empty'){
            data = $.parseJSON(data);
            gProductoTemporal = data;
            $("#spanDisponibles").html( data['disponible'] )
            if(data['sub'] != 0){
              var listaSubStock = '';
              for(var x=0; x<(data['listaStock']).length; x++){
                if(data['listaStock'][x]['disp'] == 1){
                  listaSubStock += '<tr class="subStockDisp" meta="'+data['listaStock'][x]['noControl']+'">';
                } else {
                  listaSubStock += '<tr class="subStockNoDisp">';
                }
                listaSubStock += '<td>'+data['listaStock'][x]['noControl']+'</td>';
                if(data['listaStock'][x]['disp'] == 1){
                  listaSubStock += '<td>SI</td>'+
                                    '<td> - </td>';
                } else {
                  listaSubStock += '<td>NO</td>'+
                                    '<td>'+data['listaStock'][x]['comisionado']+'</td>';
                }
                listaSubStock += '</tr>';
              }
              $("#tabForSubStockAct").html(listaSubStock);
              $(".fondoTransparencia3, #divForStock").show(500);
            }
          } else {
            $("#spanDisponibles").html( 0 )
          }
        })
        .fail(function(){
          console.log('testProducto("falló")');
        });
      }

      //-- guarda datos de la Salida en la DB
      function addSalida(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", fechaSalida:$("#forSalFechaSalida").val(),
                    noArea: $("#forSalArea").val(), nomSol: $("#forSalNomSol").val(),
                    fechaDev: $("#forSalFechaDev").val(), destino: $("#forSalDestino").val(),
                    obs: $("#forSalObs").val(), listaSalidas: JSON.stringify(prodList), anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/salidas/addSalida') }}"
        })
        .done(function(data){
          console.log('addSalida("ok")');
          $(".fondoTransparencia, #divForSalida").hide();
          $('#formSalida')[0].reset();
          prodList = [];
          pintaSalidas();
          muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Salida registrada exitosamente');
        })
        .fail(function(){
          console.log('addSalida("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- modificar los datos de la Salida en la DB
      function ediSalida(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id:$("#forEdiSalId").val(), fechaSalida:$("#forEdiSalFechaSalida").val(),
                    noArea: $("#forEdiSalArea").val(), nomSol: $("#forEdiSalNomSol").val(),
                    fechaDev: $("#forEdiSalFechaDev").val(), destino: $("#forEdiSalDestino").val(),
                    obs: $("#forEdiSalObs").val(), listaSalidas: JSON.stringify(prodList), anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/salidas/ediSalida') }}"
        })
        .done(function(data){
          console.log('ediSalida("ok")');
          $(".fondoTransparencia, #divForEdiSalida").hide();
          $('#formEdiSalida')[0].reset();
          prodList = [];
          pintaSalidas();
        })
        .fail(function(){
          console.log('ediSalida("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- obtiene y pinta la lista de salidas
      function pintaSalidas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/salidas/getSalidas') }}"
        })
        .done(function(data){
          console.log('pintaSalidas("ok")');
          console.log(data);
          var lista = '<table class="table table-sm tabLisSalidas">'+
                        '<thead>'+
                          //'<tr>'+
                            '<th>#</th>'+
                            '<th>Fecha de Salida</th>'+
                            '<th>Solicita</th>'+
                            '<th>Fecha de Devolución</th>'+
                            '<th>Destino</th>'+
                            '<th>Observaciones</th>'+
                            '<th>Lista de Productos</th>'+
                          //'<tr>'+
                        '</thead>'+
                        '<tbody>';
          if(data != 'empty'){
            data = $.parseJSON(data);
            gListaSalidas = data;
            for(var x=0; x<data.length; x++){
              lista += '<tr>'+
                         '<td>'+data[x]['id']+'</td>'+
                         '<td>'+data[x]['fechaSalida']+'</td>'+
                         '<td>'+data[x]['nomSol']+'</td>'+
                         '<td>'+data[x]['fechaDev']+'</td>'+
                         '<td>'+data[x]['destino']+'</td>'+
                         '<td>'+data[x]['obs']+'</td>'+
                         '<td>'+
                          '<button class="showList" data="'+data[x]['id']+'"><i class="fas fa-list-ul fa-lg"></i></button>'+
                          '<table  class="listProdTable" id="listProdTable-'+data[x]['id']+'" status="hidden">'+
                            '<thead> <td>#</td> <td>Producto</td> <td>Cantidad</td> </thead>';
                for(var y=0; y<(data[x]['listSalida']).length; y++){
                  lista += '<tr>'+
                              '<td>'+(y+1)+'</td>'+
                              '<td>'+data[x]['listSalida'][y]['pro_producto']+'</td>'+
                              '<td>'+data[x]['listSalida'][y]['cantidad']+' '+data[x]['listSalida'][y]['cat_uMedida']+'.</td>'+
                            '</tr>'
                }

                lista+= ''+
                            '<tr><td colspan="3">'+
                              '<button class="taskBtn plusInfo" id="'+data[x]['id']+'"> <i class="fas fa-plus fa-lg"></i> &nbsp; Info </button>'+
                            '</td></tr>'+
                            '<tr><td colspan="3">'+
                              '<button class="taskBtn impSalida" id="'+data[x]['id']+'"> <i class="fas fa-print fa-lg"></i> &nbsp; Imprimir </button>'+
                            '</td></tr>';

                if(data[x]['status'] == 0){
                  lista+= ''+
                        '<tr><td colspan="3">'+
                          '<button class="taskBtn ediSalida" id="'+data[x]['id']+'"> <i class="fas fa-pencil-alt fa-lg"></i> &nbsp; Modificar </button>'+
                        '</td></tr>'+
                        '<tr><td colspan="3">'+
                          '<button class="taskBtn delSalida" id="'+data[x]['id']+'"> <i class="far fa-trash-alt fa-lg"></i> &nbsp; Eliminar </button>'+
                        '</td></tr>';
                }

                lista+=''+
                          '</table>'+
                         '</td>'+
                        '</tr>';
            }
            lista +='</tbody>'+
                  '</table>';
          } else {
            lista = 'Lista de Salidas vacía'
          }
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
        })
        .fail(function(){
          console.log('pintaSalidas("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

      //-- pinta la lista de entradas especifica
      function pintaLisSalEspecifica(id){
        console.log('pintaLisSalEspecifica("ok")');
        for( var x=0; x<gListaSalidas.length; x++){
          if( gListaSalidas[x]['id'] == id ){
            var lista = ''+
              '<div class="row">'+
                '<div class="col-md-8">'+
                  '<div class="row">'+
                    '<div class="col-md-4 textBold"> # </div>'+
                    '<div class="col-md-4 textBold"> Fecha de la Salida: </div>'+
                    '<div class="col-md-4 textBold"> Tipo: </div>'+

                    '<div class="col-md-4 textAnswere">'+gListaSalidas[x]['id']+'</div>'+
                    '<div class="col-md-4 textAnswere">'+gListaSalidas[x]['fechaSalida']+'</div>'+
                    '<div class="col-md-4 textAnswere">SALIDA</div>'+

                    '<div class="col-md-6 textBold"> Nombre del Solicitante: </div>'+
                    '<div class="col-md-6 textBold"> Área de Adscripción: </div>'+
                    '<div class="col-md-6 textAnswere">'+gListaSalidas[x]['nomSol']+'</div>'+
                    '<div class="col-md-6 textAnswere">'+gListaSalidas[x]['are_nombre']+'</div>'+

                    '<div class="col-md-6 textBold"> Destino: </div>'+
                    '<div class="col-md-6 textBold"> Encargad@ del Area: </div>'+
                    '<div class="col-md-6 textAnswere">'+gListaSalidas[x]['destino']+'</div>'+
                    '<div class="col-md-6 textAnswere">'+gListaSalidas[x]['are_encargado']+'</div>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="row">'+
                    '<div class="col-md-12 textBold">Observaciones:</div>'+
                    '<div class="col-md-12 textAnswere">'+gListaSalidas[x]['obs']+'</div>'+
                    '<div class="col-md-12 textBold">Fecha de Devolución:</div>'+
                    '<div class="col-md-12 textAnswere">'+((gListaSalidas[x]['fechaDev'] == '0000-00-00')? 'N/A' : gListaSalidas[x]['fechaDev'])+'</div>'+
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
                    '<th>tipo</th>'+
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

                for(var y=0; y<(gListaSalidas[x]['listSalida']).length; y++){
                    lista += '<tr>'+
                               '<td>'+(y+1)+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['pro_producto']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['cat_tipo']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['cat_categoria']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['lin_linea']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['noControl']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['noSerie']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['marca']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['modelo']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['ubicacion']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['obs']+'</td>'+
                               '<td>'+gListaSalidas[x]['listSalida'][y]['cantidad']+' '+gListaSalidas[x]['listSalida'][y]['cat_uMedida']+'.</td>'+
                             '</tr>';
                }
                lista +='</tbody>'+
                      '</table>'+
              '</div>';
            $("#bloLisSalEspecificas").html(lista);
          }
        }
      }

      //-- elimina la salida seleccionada
      function eliminaSalida(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id, anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/salidas/delSalida') }}"
        })
        .done(function(data){
          console.log('eliminaSalida("ok")');
          console.log(data);
          muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Salida eliminada exitosamente');
          $(".divForm").hide();
          pintaSalidas();
        })
        .fail(function(){
          console.log('eliminaSalida("falló")');
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentar');
        });
      }

    });
  </script>
@STOP
