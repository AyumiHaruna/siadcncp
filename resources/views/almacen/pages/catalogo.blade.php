@EXTENDS('almacen.layouts.masterAlmacen')

@SECTION('title')
Almacen - Catálogo
@STOP


@SECTION('moreStyles')
<script src="{{asset('../js/jquery.dataTables.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('../css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('../css/almacen/catalogo.css')}}">
@STOP


@SECTION('content')
<!--  /////////////////////////// DIV TRANSPARENCIA ////////////////////////// -->
<div class="fondoTransparencia"></div>

<!--  /////////////////////////// DIV AVISO ////////////////////////////////// -->
<div class="col-md-4 offset-md-4 aviso text-center"></div>

<!--  /////////////////////////// MAIN DIV ////////////////////////////////// -->
<div class="col-md-10 offset-md-1 main-div">

  <div class="row divCtrBtn">
    <!-- Bloque de botones -->
    <div class="col-sm-4">
      <button type="button" class="btn btn-block btnList btnListActive" style="background-image:url(../img/almacen/catalogo/phase1.png)" id="btnLineas">LINEAS</button>
    </div>
    <div class="col-sm-4">
      <button type="button" class="btn btn-block btnList" style="background-image:url(../img/almacen/catalogo/phase2.png)" id="btnCategorias">CATEGORIAS</button>
    </div>
    <div class="col-sm-4">
      <button type="button" class="btn btn-block btnList" style="background-image:url(../img/almacen/catalogo/phase3.png)" id="btnProductos">PRODUCTOS</button>
    </div>
  </div>

    <!-- Bloque ListaLineas -->
    <div class="row divLisLineas" id="divLisLineas">
        <!-- bloque de lineas activas-->
        <div class="col-md-6 blockContainer">
          <div class="row subTitle text-center">
            <div class="col-md-10 subTitleText">
              LINEAS ACTIVAS
            </div>
            <div class="col-md-2">
              <button type="button" class="btnAdd" aria-hidden="true" id="btnAddLinea" data-toggle="tooltip" title="Nueva Linea">
                <i class="far fa-plus-square fa-3x"></i>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 noPadd">
              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>LINEAS</th> <th>&nbsp;</th> <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody id="tabLinActivas">

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- bloque de lineas inactivas-->
        <div class="col-md-6 blockContainer">
          <div class="row subTitle text-center">
            <div class="col-md-12 subTitleText">
              LINEAS INACTIVAS
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 noPadd">
              <table class="table table-sm table-striped">
                <thead>
                  <tr>
                    <th>LINEAS</th> <th>&nbsp;</th> <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody id="tabLinInactivas">

                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <!-- Bloque ListaCategorias -->
    <div class="row divLisCategorias" id="divLisCategorias">
      <!-- bloque de catergorias activas-->
      <div class="col-md-6 blockContainer">
        <div class="row subTitle text-center">
          <div class="col-md-10 subTitleText">
            CATEGORIAS ACTIVAS
          </div>
          <div class="col-md-2">
            <button type="button" class="btnAdd" aria-hidden="true" id="btnAddCategoria" data-toggle"tooltip" title="Nueva Categoría">
              <i class="far fa-plus-square fa-3x"></i>
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 noPadd">
            <table class="table table-sm table-striped tabCatAct">
              <thead>
                <tr>
                   <th>CATEGORIA</th> <th>TIPO</th> <th>LINEA</th> <th>UNIDAD</th> <th>&nbsp;</th><th>&nbsp;</th>
                </tr>
              </thead>
              <tbody id="tabCatActivas">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- bloque de categorias inactivas-->
      <div class="col-md-6 blockContainer">
        <div class="row subTitle text-center">
          <div class="col-md-12 subTitleText">
            CATEGORIAS INACTIVAS
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 noPadd">
            <table class="table table-sm table-striped tabCatIna">
              <thead>
                <tr>
                  <th>CATEGORIA</th> <th>TIPO</th> <th>LINEA</th> <th>UNIDAD</th> <th>&nbsp;</th><th>&nbsp;</th>
                </tr>
              </thead>
              <tbody id="tabCatInactivas">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bloque ListaProductos -->
    <div class="row divLisProductos" id="divLisProductos">
      <!-- bloque de productos activos-->
      <div class="col-md-6 blockContainer">
        <div class="row subTitle text-center">
          <div class="col-md-10 subTitleText">
            PRODUCTOS ACTIVOS
          </div>
          <div class="col-md-2">
            <button type="button" class="btnAdd" aria-hidden="true" id="btnAddProducto" data-toggle="tooltip" title="Nuevo Producto">
              <i class="far fa-plus-square fa-3x"></i>
            </button>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 noPadd">
            <table class="table table-sm table-striped tabProAct">
              <thead>
                <tr>
                  <th>PRODUCTO</th> <th>LINEA</th> <th>CATEGORIA</th><th>STOCK MÍNIMO</th><th>&nbsp;</th><th>&nbsp;</th>
                </tr>
              </thead>
              <tbody id="tabProActivos">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- bloque de productos inactivos-->
      <div class="col-md-6 blockContainer">
        <div class="row subTitle text-center">
          <div class="col-md-12 subTitleText">
            PRODUCTOS INACTIVOS
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 noPadd">
            <table class="table table-sm table-striped tabProIna">
              <thead>
                <tr>
                  <th>PRODUCTO</th> <th>LINEA</th> <th>CATEGORIA</th><th>STOCK MÍNIMO</th><th>&nbsp;</th><th>&nbsp;</th>
                </tr>
              </thead>
              <tbody id="tabProInactivos">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

<!--  /////////////////////////// FORM LINEAS ////////////////////////////////// -->
<div class="col-md-4 offset-md-4 divForm" id="divForLineas">
  <div class="row">
    <div class="col-md-12 titulo" style="background-image:url(../img/almacen/catalogo/phase1.png)">
        NUEVA LINEA
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-left">
        <form id="formLinea">
          <label for="forlinLinea">Linea:</label>
          <input type="text" id="forLinLinea" class="form-control" maxlength="20" placeholder="ej. papelería" data-toggle="tooltip" title="Nombre de la Linea">
        </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
      <button type="button" id="btnLinCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
    </div>
    <div class="col-sm-6 text-center">
      <button type="button" id="btnLinAceptar" class="btn btn-block btnAction btnAcept">AGREGAR</button>
    </div>
  </div>
</div>

<!--  /////////////////////////// FORM LINEAS EDI ////////////////////////////////// -->
<div class="col-md-4 offset-md-4 divForm" id="divForEdiLineas">
  <div class="row">
    <div class="col-md-12 titulo withMargin" style="background-image:url(../img/almacen/catalogo/phase1.png)">
        MODIFICAR LINEA
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-left">
        <form id="formEdiLinea">
          <label for="forlinEdiLinea">Linea:</label>
          <input type="text" id="forLinEdiLinea" class="form-control" maxlength="20" placeholder="ej. papelería" data-toggle="tooltip" title="Nombre de la Linea">
          <input type="hidden" id="forLinEdiId">
        </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
      <button type="button" id="btnLinCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
    </div>
    <div class="col-sm-6 text-center">
      <button type="button" id="btnLinEdiAceptar" class="btn btn-block btnAction btnAcept">MODIFICAR</button>
    </div>
  </div>
</div>

<!--  /////////////////////////// FORM CATEGORIAS ////////////////////////////////// -->
<div class="col-md-6 offset-md-3 divForm" id="divForCategoria">
  <div class="row">
    <div class="col-md-12 titulo" style="background-image:url(../img/almacen/catalogo/phase2.png)">
        NUEVA CATEGORÍA
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <form id="formCategoria">
        <div class="row">
          <div class="col-md-6">
            <label for="forCatLinea">Linea:</label>
            <select class="form-control" id="forCatLinea">
            </select>
          </div>
          <div class="col-md-6">
            <label for="forCatTipo">Tipo:</label>
            <input type="hidden" id="forCatEdiId">
            <select class="form-control" id="forCatTipo">
              <option value="CON">CONSUMIBLES</option>
              <option value="BII">BIENES INVENTARIABLES</option>
              <option value="BIN">BIENES NO INVENTARIABLES</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="forCatCategoria">Categoría:</label>
            <input type="text" class="form-control" id="forCatCategoria">
          </div>
          <div class="col-md-6">
            <label for="forCatUMedida">Unidad de Medida:</label>
            <select class="form-control" id="forCatUMedida">
              <option value="MT">METROS</option>
              <option value="LT">LITROS</option>
              <option value="GR">GRAMOS</option>
              <option value="UN">UNIDADES</option>
              <option value="PK">PAQUETES</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
        <button type="button" id="btnCatCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
    </div>
    <div class="col-sm-6 text-center">
      <button type="button" id="btnCatAceptar" class="btn btn-block btnAction btnAcept">AGREGAR</button>
    </div>
  </div>
</div>

<!--  /////////////////////////// FORM CATEGORIAS EDI ////////////////////////////////// -->
<div class="col-md-6 offset-md-3 divForm" id="divForEdiCategorias">
  <div class="row">
    <div class="col-md-12 titulo" style="background-image:url(../img/almacen/catalogo/phase2.png)">
        MODIFICAR CATEGORÍA
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <form id="formEdiCategoria">
        <div class="row">
          <div class="col-sm-6">
            <label for="forCatEdiLinea">Linea:</label>
            <select class="form-control" id="forCatEdiLinea" disabled>
            </select>
          </div>
          <div class="col-sm-6">
            <label for="forCatEdiTipo">Tipo:</label>
            <select class="form-control" id="forCatEdiTipo" disabled>
              <option value="CON">CONSUMIBLES</option>
              <option value="BII">BIENES INVENTARIABLES</option>
              <option value="BIN">BIENES NO INVENTARIABLES</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label for="forCatEdiCategoria">Categoría:</label>
            <input type="text" class="form-control" id="forCatEdiCategoria">
          </div>
          <div class="col-sm-6">
            <label for="forCatEdiUMedida">Unidad de<br>Medida:</label>
            <select class="form-control" id="forCatEdiUMedida">
              <option value="MT">METROS</option>
              <option value="LT">LITROS</option>
              <option value="GR">GRAMOS</option>
              <option value="UN">UNIDADES</option>
              <option value="PK">PAQUETES</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
        <button type="button" id="btnCatCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
    </div>
    <div class="col-sm-6 text-center">
      <button type="button" id="btnCatEdiAceptar" class="btn btn-block btnAction btnAcept">MODIFICAR</button>
    </div>
  </div>
</div>

<!--  /////////////////////////// FORM PRODUCTOS ////////////////////////////////// -->
<div class="col-md-6 offset-md-3 divForm" id="divForProducto">
  <div class="row">
    <div class="col-md-12 titulo" style="background-image:url(../img/almacen/catalogo/phase3.png)">
        NUEVO PRODUCTO
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form id="formProducto">
        <div class="row">
          <div class="col-md-6">
            <label for="forProLinea">Linea:</label>
            <select class="form-control" id="forProLinea">
            </select>
          </div>
          <div class="col-md-6">
            <label for="forProCategoria">Categoría:</label>
            <select class="form-control" id="forProCategoria">
            </select>
          </div>
          <div class="col-sm-12">
            <label for="forProProducto">Producto:</label>
            <input type="text" class="form-control" id="forProProducto">
          </div>
          <div class="col-sm-5">
            <label for="forProMinStock">Stock mínimo:</label>
            <input type="number" class="form-control" id="forProMinStock">
          </div>
          <div class="col-sm-1"> <br> <span id="proUnidades"></span> </div>
          <div class="col-sm-6 text-center"> <br> <span id="proCatTipo"></span> </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
        <button type="button" id="btnProCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
    </div>
    <div class="col-sm-6 text-center">
      <button type="button" id="btnProAceptar" class="btn btn-block btnAction btnAcept">AGREGAR</button>
    </div>
  </div>

</div>

<!--  /////////////////////////// FORM PRODUCTOS EDI ////////////////////////////////// -->
<div class="col-md-6 offset-md-3 divForm" id="divForEdiProducto">
  <div class="row">
    <div class="col-md-12 titulo" style="background-image:url(../img/almacen/catalogo/phase3.png)">
        MODIFICA PRODUCTO
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form id="formEdiProducto">
        <div class="row">
          <div class="col-sm-6">
            <label for="forProEdiLinea">Linea:</label>
            <select class="form-control" id="forProEdiLinea" disabled>
            </select>
            <input type="hidden" id="forProEdiId">
          </div>
          <div class="col-sm-6">
            <label for="forProEdiCategoria">Categoría:</label>
            <select class="form-control" id="forProEdiCategoria" disabled>
            </select>
          </div>
          <div class="col-sm-12">
            <label for="forProEdiProducto">Producto:</label>
            <input type="text" class="form-control" id="forProEdiProducto">
          </div>
          <div class="col-sm-6">
            <label for="forProEdiMinStock">Stock mínimo:</label>
            <input type="number" class="form-control" id="forProEdiMinStock">
          </div>
          <div class="col-sm-1"> <br> <span id="proEdiUnidades"></span> </div>
          <div class="col-sm-6 text-center"> <br> <span id="ediProCatTipo"></span> </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
        <button type="button" id="btnProEdiCancelar" class="btn btn-block btnAction btnCancel">CANCELAR</button>
    </div>
    <div class="col-sm-6 text-center">
      <button type="button" id="btnProEdiAceptar" class="btn btn-block btnAction btnAcept">MODIFICAR</button>
    </div>
  </div>
</div>
@STOP


@SECTION('script')
<script type="text/javascript">
  $(document).ready(function(){
    //                VARIABLES GLOBALES
    //---------------------------------------------------
    var gListaLineas = [];
    var gListaCategorias = [];
    var gListaProductos = [];

    //                CONDICIONES INICIALES
    //---------------------------------------------------
    //$('[data-toggle="tooltip"]').tooltip();
    $(".aviso").hide();
    $(".fondoTransparencia, .divForm").hide();
    showDivList('Lineas');
    $.get(ajaxCargaLineas()).then(ajaxCargaCategorias(), ajaxCargaProductos());

    //--convierte todos los inputs a mayusculas
    $('input').keyup(function() {
      this.value = this.value.toUpperCase();
    });

    //                ACCIONES DEL DOM
    //---------------------------------------------------
    //-- solicita la vista de una lista específica
    $(".btnList").click(function(){
      $("#btnLineas, #btnCategorias, #btnProductos").removeClass("btnListActive");
      $(this).addClass('btnListActive');
      switch ( $(this).attr('id') ) {
        case 'btnLineas':
          showDivList('Lineas');
        break;
        case 'btnCategorias':
          showDivList('Categorias');
        break;
        case 'btnProductos':
          showDivList('Productos');
        break;
      }
    });

    //-- Muestra formulario para agregar Lineas
    $(".btnAdd").click(function(){
      switch ( $(this).attr('id') ) {
        case 'btnAddLinea':
          $(".fondoTransparencia, #divForLineas").show(500);
        break;

        case 'btnAddCategoria':
          $(".fondoTransparencia, #divForCategoria").show(500);
          ajaxFillFormLineas();
        break;

        case 'btnAddProducto':
          $(".fondoTransparencia, #divForProducto").show(500);
          ajaxFillFormLineas();
        break;
      }
    });

    //-- Cierra cuadros de formularios y los resetea
    $(".btnCancel").click(function(){
      $(".fondoTransparencia, .divForm").hide();
      switch( $(this).attr("id") ){
        case 'btnLinCancelar':
          $('#formLinea')[0].reset();
        break;

        case 'btnCatCancelar':
          $('#formCategoria')[0].reset();
        break;

        case 'btnProCancelar':
          $("#formProducto")[0].reset();
          $("#proCatTipo, #ediProCatTipo").html('');
        break;
      }
    });

    //-- Valida formularios y llama funciones ajax
    $(".btnAcept").click(function(){
      switch( $(this).attr("id") ){
        case 'btnLinAceptar':
          if( $("#forLinLinea").val() != ''){
            ajaxAddLinea();
          }  else {
            muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
            $("#forLinLinea").focus();
          }
        break;

        case 'btnLinEdiAceptar':
          if( $("#forLinEdiLinea").val() != ''){
            ajaxEdiLinea();
          }  else {
            muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
            $("#forLinEdiLinea").focus();
          }
        break;

        case 'btnCatAceptar':
          if( $("#forCatTipo").val() != '' ){
            if( $("#forCatLinea").val() != '' ){
              if( $("#forCatCategoria").val() != '' ){
                if( $("#forCatUMedida").val() != '' ){
                    ajaxAddCategoria();
                } else {
                  muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
                  $("#forCatUMedida").focus();
                }
              } else {
                muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
                $("#forCatCategoria").focus();
              }
            } else {
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
              $("#forCatLinea").focus();
            }
          } else {
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Tipo');
            $("#forCatTipo").focus();
          }
        break;

        case 'btnCatEdiAceptar':
          if( $("#forCatEdiTipo").val() != '' ){
            if( $("#forCatEdiLinea").val() != '' ){
              if( $("#forCatEdiCategoria").val() != '' ){
                if( $("#forCatEdiUMedida").val() != '' ){
                    ajaxEdiCategoria();
                } else {
                  muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
                  $("#forCatEdiUMedida").focus();
                }
              } else {
                muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
                $("#forCatEdiCategoria").focus();
              }
            } else {
              muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
              $("#forCatEdiLinea").focus();
            }
          } else {
            muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Tipo');
            $("#forCatEdiTipo").focus();
          }
        break;

        case 'btnProAceptar':
          if( $("#forProLinea").val() != ""){
            if( $("#forProCategoria").val() != ""){
              if( $("#forProProducto").val() != ""){
                if( $("#forProMinStock").val() != ""){
                  ajaxAddProducto();
                } else {
                  muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Stock Mínimo');
                  $("#forProMinStock").focus();
                }
              } else {
                muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Producto');
                $("#forProProducto").focus();
              }
            } else {
              muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
              $("#forProCategoria").focus();
            }
          } else {
            muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
            $("#forProLinea").focus();
          }
        break;

        case 'btnProEdiAceptar':
          if( $("#forProEdiLinea").val() != ""){
            if( $("#forProEdiCategoria").val() != ""){
              if( $("#forProEdiProducto").val() != ""){
                if( $("#forProEdiMinStock").val() != ""){
                  ajaxEdiProducto();
                } else {
                  muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Stock Mínimo');
                  $("#forProEdiMinStock").focus();
                }
              } else {
                muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar el Producto');
                $("#forProEdiProducto").focus();
              }
            } else {
              muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Categoría');
              $("#forProEdiCategoria").focus();
            }
          } else {
            muestraAviso('', '<i class="far fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Falta capturar la Linea');
            $("#forProEdiLinea").focus();
          }
        break;
      }
    });

    //-- activa MiniSitch function
    $("#tabLinActivas, #tabLinInactivas, #tabCatActivas, #tabCatInactivas, #tabProActivos, #tabProInactivos").on('click', '.miniSwitch, .miniEdit', function(){
      switch ( $(this).attr("origin") ) {
        case 'linActivo':
          ajaxInhabilitaLinea( $(this).attr('id') );
        break;

        case 'linInactivo':
          ajaxHabilitaLinea( $(this).attr('id') );
        break;

        case 'linMod':
          $("#forLinEdiLinea").val( $(this).attr('data') );
          $("#forLinEdiId").val( $(this).attr('id') );
          $(".fondoTransparencia, #divForEdiLineas").show(500);
        break;

        case 'catActivo':
          ajaxInhabilitaCategoria( $(this).attr('id') );
        break;

        case 'catInactivo':
          ajaxHabilitaCategoria( $(this).attr('id') );
        break;

        case 'catMod':
          ajaxFillFormLineas();
          ajaxFillFormEdiCategorias( $(this).attr('id') );
          $(".fondoTransparencia, #divForEdiCategorias").show(500);
        break;

        case 'proActivo':
          ajaxInhabilitaProducto( $(this).attr('id') );
        break;

        case 'proInactivo':
          ajaxHabilitaProducto( $(this).attr('id') );
        break;

        case 'proMod':
          ajaxFillFormLineas();
          ajaxFillFormEdiProductos( $(this).attr('id') );
          $(".fondoTransparencia, #divForEdiProducto").show(500);
        break;
      }
    });

    //-- Elimina funcion de ENTER en los formularios
    $("#formLinea, #formEdiLinea, #formCategoria, #formEdiCategoria, #formProducto, #formEdiProducto").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
      if (e.which == 13) {
        switch ( $(this).attr("id") ) {
          case 'formLinea':
            $('#btnLinAceptar').trigger('click');
          break;

          case 'formEdiLinea':
            $('#btnLinEdiAceptar').trigger('click');
          break;

          case 'formCategoria':
            $("#btnCatAceptar").trigger('click');
          break;

          case 'formEdiCategoria':
            $("#btnCatEdiAceptar").trigger('click');
          break;

          case 'formProducto':
            $("#btnProAceptar").trigger('click');
          break;

          case 'formEdiProducto':
            $("#btnProEdiAceptar").trigger('click');
          break;
        }
        return false;
      }
    });

    //-- pide rellenar categorias de X linea
    $("#forProLinea, #forProEdiLinea").change(function(){
      ajaxFillFormCategorias( $(this).val() );
    });

    //-- pide los datos de la categoria seleccionada
    $("#forProCategoria, #forProEdiCategoria").change(function(){
      ajaxFillFormProdUMedida( $(this).val() );
    });

    //                FUNCIONES GENERALES
    //---------------------------------------------------
    //-- Muestra avisos
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

    //-- Muestra el DIV de listas seleccionado
    function showDivList(thisDiv){
      $("#divLisLineas, #divLisCategorias, #divLisProductos").hide();
      $("#divLis"+thisDiv).show(500);
    }

    //                FUNCIONES AJAX y CARGA DE DATOS
    //---------------------------------------------------
    //-- LINEAS
      function ajaxCargaLineas(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/getLineas') }}"
        })
        .done(function(data){
          console.log('ajaxCargaLineas(ok)');
          var lisLinActivas = '';
          var lisLinInactivas = '';
          gListaLineas = [];
          if(data != 'empty'){
            data = $.parseJSON(data);
            gListaLineas = data;
            for(var x=0; x<data.length; x++){
              if(data[x]['activo'] == 1){
                lisLinActivas += '<tr>'+
                                '<td>'+data[x]['linea']+'</td>'+
                                '<td class="text-center"><button type="button" class="miniSwitch pseudoBtn" id="'+data[x]['id']+'" origin="linActivo" data-toggle="tooltip" title="Deshabilitar" aria-hidden="true"> <i class="fas fa-toggle-on fa-lg"></i> </button></td>'+
                                '<td class="text-center"><button type="button" class="miniEdit pseudoBtn" id="'+data[x]['id']+'" origin="linMod" data="'+data[x]['linea']+'" data-toggle="tooltip" title="Modificar" aria-hidden="true"> <i class="fas fa-pencil-alt fa-lg"></i> </button></td>'+
                              '</tr>';
              } else {
                lisLinInactivas += '<tr>'+
                                '<td>'+data[x]['linea']+'</td>'+
                                '<td class="text-center"><button type="button" class="miniSwitch pseudoBtn" id="'+data[x]['id']+'" origin="linInactivo" data-toggle="tooltip" title="Habilitar" aria-hidden="true"><i class="fas fa-toggle-off fa-lg"></i></button></td>'+
                                '<td class="text-center"><button type="button" class="miniEdit pseudoBtn" id="'+data[x]['id']+'" origin="linMod" data="'+data[x]['linea']+'" data-toggle="tooltip" title="Modificar" aria-hidden="true"><i class="fas fa-pencil-alt fa-lg"></i></button></td>'+
                              '</tr>';
              }
            }
          }
          if(lisLinActivas == ''){
            lisLinActivas += '<span style="color:red"> Lista de "Lineas" vacía </span>';
          }
          if(lisLinInactivas == ''){
            lisLinInactivas += '<span style="color:red"> Lista de "Lineas" vacía </span>';
          }
          $("#tabLinActivas").html(lisLinActivas);
          $("#tabLinInactivas").html(lisLinInactivas);
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxCargaLineas("falló")');
        });
      }

      function ajaxAddLinea(){
        $.ajax({
              data: { "_token": "{{ csrf_token() }}", linea:$("#forLinLinea").val(), anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/catalogo/addLinea') }}"
          })
          .done(function(data){
            console.log('ajaxAddLinea(ok)');
            if(data == '3'){
              $(".fondoTransparencia, .divForm").hide();
              $('#formLinea')[0].reset();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La linea fue capturada exitosamente');
              ajaxCargaLineas();
            } else if(data == '2') {
              $(".fondoTransparencia, .divForm").hide();
              $('#formLinea')[0].reset();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La linea fue rehabilitada exitosamente');
              ajaxCargaLineas();
            } else if(data == '1'){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Esta linea ya fué previamente capturada');
            }
          })
          .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxAddLinea("falló")');
          });
      }

      function ajaxEdiLinea(){
        $.ajax({
              data: { "_token": "{{ csrf_token() }}", linea:$("#forLinEdiLinea").val(), id:$("#forLinEdiId").val(), anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/catalogo/ediLinea') }}"
          })
          .done(function(data){
            console.log('ajaxEdiLinea(ok)');
            if(data == 0){
              $(".fondoTransparencia, .divForm").hide();
              $('#formEdiLinea')[0].reset();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La linea se modificó exitosamente');
              ajaxCargaLineas();
            } else if( data == 1){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Esta linea ya está repetida');
            }
          })
          .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxEdiLinea("falló")');
          });
      }

      function ajaxInhabilitaLinea(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/inhabilitaLinea') }}"
        })
        .done(function(data){
          console.log('ajaxInhabilitaLinea(ok)');
          if( data == 'ok' ){
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Linea se deshabilitó exitosamente');
            ajaxCargaLineas();
          }
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxInhabilitaLinea("falló")');
        });
      }

      function ajaxHabilitaLinea(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/habilitaLinea') }}"
        })
        .done(function(data){
          console.log('InajaxHabilitaLinea(ok)');
          if( data == 'ok' ){
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Linea se habilitó exitosamente');
            ajaxCargaLineas();
          }
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('InajaxHabilitaLinea("falló")');
        });
      }

    //-- CATEGORIAS
      function ajaxFillFormLineas(){
        console.log('ajaxFillFormLineas(ok)');
        if(gListaLineas.length > 0){
          var lista = '<option value="">-- Seleccione una Linea </option>';
          for(var x=0; x<gListaLineas.length; x++){
            if(gListaLineas[x]['activo'] == 1){
              lista += '<option value="'+gListaLineas[x]['id']+'">'+gListaLineas[x]['linea']+'</option>';
            }
          }
        } else {
          var lista = '<option>--Lista Vacía--</option>'
        }
        $("#forCatLinea, #forCatEdiLinea, #forProLinea, #forProEdiLinea").html(lista);
      }

      function ajaxAddCategoria(){
        $.ajax({
              data: { "_token": "{{ csrf_token() }}", tipo:$("#forCatTipo").val(), linea:$("#forCatLinea").val(),
                                categoria:$("#forCatCategoria").val(), uMedida:$("#forCatUMedida").val(),
                                anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/catalogo/addCategoria') }}"
          })
          .done(function(data){
            console.log('ajaxAddCategoria(ok)');
            if(data == '3'){
              $(".fondoTransparencia, .divForm").hide();
              $('#formCategoria')[0].reset();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Categoría fue capturada exitosamente');
              ajaxCargaCategorias();
            } else if(data == '2') {
              $(".fondoTransparencia, .divForm").hide();
              $('#formCategoria')[0].reset();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Categoría fue rehabilitada exitosamente');
              ajaxCargaCategorias();
            } else if(data == '1'){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Esta categoría ya fué previamente capturada');
            }
          })
          .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxAddCategoria("falló")');
          });
      }

      function ajaxCargaCategorias(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/getCategorias') }}"
        })
        .done(function(data){
          console.log('ajaxCargaCategorias(ok)');
          var lisCatActivos = '';
          var lisCatInactivos = '';
          gListaCategorias = [];
          if(data != 'empty'){
            data = $.parseJSON(data);
            gListaCategorias = data;
            for(var x=0; x<data.length; x++){
              if(data[x]['activo'] == 1){
                lisCatActivos += '<tr>'+
                                '<td>'+data[x]['categoria']+'</td>';
                                switch (data[x]['tipo']) {
                                  case 'CON':
                                      lisCatActivos +='<td>CONSUMIBLES</td>';
                                    break;
                                  case 'BII':
                                      lisCatActivos +='<td>BIENES INVENTARIABLES</td>';
                                    break;
                                  case 'BIN':
                                      lisCatActivos +='<td>BIENES NO INVENTARIABLES</td>';
                                    break;
                                }
                lisCatActivos +=   '<td>'+data[x]['linea']+'</td>'+
                                '<td>'+data[x]['uMedida']+'.</td>'+
                                '<td class="text-center"><button type="button" class="miniSwitch pseudoBtn" id="'+data[x]['id']+'" origin="catActivo" data-toggle="tooltip" title="Deshabilitar" aria-hidden="true"><i class="fas fa-toggle-on fa-lg"></i></button></td>'+
                                '<td class="text-center"><button type="button" class="miniEdit pseudoBtn" id="'+data[x]['id']+'" origin="catMod" data="'+data[x]['linea']+'" data-toggle="tooltip" title="Modificar" aria-hidden="true"> <i class="fas fa-pencil-alt fa-lg"></i> </button></td>'+
                                '</td>'+
                              '</tr>';
              } else {
                lisCatInactivos += '<tr>'+
                                '<td>'+data[x]['categoria']+'</td>';
                                switch (data[x]['tipo']) {
                                  case 'CON':
                                      lisCatInactivos +='<td>CONSUMIBLES</td>';
                                    break;
                                  case 'BII':
                                      lisCatInactivos +='<td>BIENES INVENTARIABLES</td>';
                                    break;
                                  case 'BIN':
                                      lisCatInactivos +='<td>BIENES NO INVENTARIABLES</td>';
                                    break;
                                }
                lisCatInactivos +=   '<td>'+data[x]['linea']+'</td>'+
                                '<td>'+data[x]['uMedida']+'.</td>'+
                                '<td class="text-center"> <button type="button" class="miniSwitch pseudoBtn" id="'+data[x]['id']+'" origin="catInactivo" data-toggle="tooltip" title="Deshabilitar" aria-hidden="true"> <i class="fas fa-toggle-on fa-lg"></i></button></td>'+
                                '<td class="text-center"> <button type="button" class="miniEdit pseudoBtn" id="'+data[x]['id']+'" origin="catMod" data="'+data[x]['linea']+'" data-toggle="tooltip" title="Modificar" aria-hidden="true"> <i class="fas fa-pencil-alt fa-lg"></i></button></td>'+
                                '</td>'+
                              '</tr>';
              }
            }
          }
          if(lisCatActivos == ''){
            lisCatActivos += '<span style="color:red"> Lista de "Categorias" vacía </span>';
          }
          if(lisCatInactivos == ''){
            lisCatInactivos += '<span style="color:red"> Lista de "Categorias" vacía </span>';
          }
          $("#tabCatActivas").html(lisCatActivos);
          $("#tabCatInactivas").html(lisCatInactivos);
          /*$('.tabCatAct, .tabCatIna').DataTable({
            "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
            "paging": false,
            "info": false
          });*/
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxCargaCategorias("falló")');
        });
      }

      function ajaxInhabilitaCategoria(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/inhabilitaCategoria') }}"
        })
        .done(function(data){
          console.log('ajaxInhabilitaCategoria(ok)');
          if( data == 'ok' ){
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Categoría se deshabilitó exitosamente');
            ajaxCargaCategorias();
          }
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxInhabilitaCategoria("falló")');
        });
      }

      function ajaxHabilitaCategoria(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/habilitaCategoria') }}"
        })
        .done(function(data){
          console.log('ajaxHabilitaCategoria(ok)');
          if( data == 'ok' ){
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Categoría se deshabilitó exitosamente');
            ajaxCargaCategorias();
          }
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxHabilitaCategoria("falló")');
        });
      }

      function ajaxFillFormEdiCategorias(id){
        console.log('ajaxFillFormEdiCategorias(ok)');
        for(var x = 0; x <= (gListaCategorias.length); x++){
          if( gListaCategorias[x]['id'] == id){
            $("#forCatEdiId").val( gListaCategorias[x]['id'] );
            $("#forCatEdiTipo").val( gListaCategorias[x]['tipo'] );
            $("#forCatEdiLinea").val( gListaCategorias[x]['noLinea'] );
            $("#forCatEdiCategoria").val( gListaCategorias[x]['categoria'] );
            $("#forCatEdiUMedida").val( gListaCategorias[x]['uMedida'] );

            break;
          }
        }
      }

      function ajaxEdiCategoria(){
        $.ajax({
              data: { "_token": "{{ csrf_token() }}", id:$("#forCatEdiId").val(), tipo:$("#forCatEdiTipo").val(), linea:$("#forCatEdiLinea").val(),
                                categoria:$("#forCatEdiCategoria").val(), uMedida:$("#forCatEdiUMedida").val(), anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/catalogo/ediCategoria') }}"
          })
          .done(function(data){
            console.log('ajaxEdiCategoria(ok)');
            if(data == '2'){
              $(".fondoTransparencia, .divForm").hide();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; La Categoría se modificó exitosamente');
              ajaxCargaCategorias();
            } else if(data == '1'){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Esta categoría ya fué previamente capturada');
            }
          })
          .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxEdiCategoria("falló")');
          });
      }

    //-- PRODUCTOS
      function ajaxCargaProductos(){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/getProductos') }}"
        })
        .done(function(data){
          console.log('ajaxCargaProductos(ok)');
          var lisProActivos = '';
          var lisProInactivos = '';
          gListaProductos = [];
          if(data != 'empty'){
            data = $.parseJSON(data);
            gListaProductos = data;
            for(var x=0; x<data.length; x++){
              //obtenemos el tipo de la categoria a la que pertenece el PRODUCTO
              var tipoCat = 0;
              for(var y=0; y<(gListaCategorias.length); y++){
                if( data[x]['noCategoria'] == gListaCategorias[y]['id'] ){
                  tipoCat = gListaCategorias[y]['tipo'];
                  break;
                }
              }
              if(data[x]['activo'] == 1){
                lisProActivos += '<tr>'+
                                '<td>'+data[x]['producto']+'</td>'+
                                '<td>'+data[x]['linea']+'</td>'+
                                '<td>'+data[x]['categoria']+' ('+tipoCat+')</td>'+
                                '<td>'+data[x]['minStock']+' '+data[x]['uMedida']+'.</td>'+
                                '<td><button type="button" class="miniSwitch pseudoBtn" id="'+data[x]['id']+'" origin="proActivo" data-toggle="tooltip" title="Deshabilitar" aria-hidden="true"><i class="fas fa-toggle-on fa-lg"></i></button></td>'+
                                '<td><button type="id" class="miniEdit pseudoBtn" id="'+data[x]['id']+'" origin="proMod" data="'+data[x]['producto']+'" data-toggle="tooltip" title="Modificar" aria-hidden="true"><i class="fas fa-pencil-alt fa-lg"></i></button></td>'+
                                '</td>'+
                              '</tr>';
              } else {
                lisProInactivos += '<tr>'+
                                '<td>'+data[x]['producto']+'</td>'+
                                '<td>'+data[x]['linea']+'</td>'+
                                '<td>'+data[x]['categoria']+' ('+tipoCat+')</td>'+
                                '<td>'+data[x]['minStock']+' '+data[x]['uMedida']+'.</td>'+
                                '<td><button type="button" class="miniSwitch pseudoBtn" id="'+data[x]['id']+'" origin="proInactivo" data-toggle="tooltip" title="Habilitar" aria-hidden="true"><i class="fas fa-toggle-on fa-lg"></i></button></td>'+
                                '<td><button type="button" class="miniEdit pseudoBtn" id="'+data[x]['id']+'" origin="proMod" data="'+data[x]['producto']+'" data-toggle="tooltip" title="Modificar" aria-hidden="true"><i class="fas fa-pencil-alt fa-lg"></i></button></td>'+
                                '</td>'+
                              '</tr>';
              }
            }
          }
          if(lisProActivos == ''){
            lisProActivos += '<span style="color:red"> Lista de "Productos" vacía </span>';
          }
          if(lisProInactivos == ''){
            lisProInactivos += '<span style="color:red"> Lista de "Productos" vacía </span>';
          }
          $("#tabProActivos").html(lisProActivos);
          $("#tabProInactivos").html(lisProInactivos);
          /*$('.tabCatAct, .tabCatIna').DataTable({
            "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
            "paging": false,
            "info": false
          });*/
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxCargaProductos("falló")');
        });
      }

      function ajaxFillFormCategorias(linea){
        console.log('ajaxFillFormCategorias(ok)');
        if (gListaCategorias.length > 0){
          var lista = '<option value=""> Seleccione una Categoría </option>';
          for(var x=0; x<gListaCategorias.length; x++){
            if(gListaCategorias[x]['noLinea'] == linea && gListaCategorias[x]['activo'] == 1){
              lista += '<option value="'+gListaCategorias[x]['id']+'">'+gListaCategorias[x]['categoria']+'</option>';
            }
          }
        } else {
          var lista = '<option value="">--Lista Vacía--</option>';
        }
        $("#forProCategoria, #forProEdiCategoria").html(lista);
      }

      function ajaxFillFormProdUMedida(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id, anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/getCategoriaEspecifica') }}"
        })
        .done(function(data){
          console.log('ajaxFillFormProdUMedida(ok)');
          data = $.parseJSON(data);
          $("#proUnidades, #proEdiUnidades").html(data['uMedida']+'.');
          switch (data['tipo']) {
            case 'CON':
                $("#proCatTipo, #ediProCatTipo").html('CONSUMIBLE');
              break;
            case 'BII':
                $("#proCatTipo, #ediProCatTipo").html('BIEN INVENTARIABLE');
              break;
            case 'BIN':
                $("#proCatTipo, #ediProCatTipo").html('BIEN NO INVENTARIABLE');
              break;
          }
        })
        .fail(function(){
          console.log('ajaxFillFormProdUMedida("falló")');
        });
      }

      function ajaxAddProducto(){
        $.ajax({
              data: { "_token": "{{ csrf_token() }}", linea:$("#forProLinea").val(),
                      categoria:$("#forProCategoria").val(), producto:$("#forProProducto").val(),
                      minStock:$("#forProMinStock").val(), anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/catalogo/addProducto') }}"
          })
          .done(function(data){
            console.log('ajaxAddProducto(ok)');
            if(data == '3'){
              $(".fondoTransparencia, .divForm").hide();
              $('#formProducto')[0].reset();
              $("#proCatTipo").html('');
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; El Producto fue capturado exitosamente');
              ajaxCargaProductos();
            } else if(data == '2') {
              $(".fondoTransparencia, .divForm").hide();
              $('#formProducto')[0].reset();
              $("#proCatTipo").html('');
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; El Producto fue rehabilitado exitosamente');
              ajaxCargaProductos();
            } else if(data == '1'){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Este Producto ya fué previamente capturado');
            }
          })
          .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxAddProducto("falló")');
          });
      }

      function ajaxInhabilitaProducto(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/inhabilitaProducto') }}"
        })
        .done(function(data){
          console.log('ajaxInhabilitaProducto(ok)');
          if( data == 'ok' ){
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; El Producto se deshabilitó exitosamente');
            ajaxCargaProductos();
          }
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxInhabilitaProducto("falló")');
        });
      }

      function ajaxHabilitaProducto(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/habilitaProducto') }}"
        })
        .done(function(data){
          console.log('ajaxHabilitaProducto(ok)');
          if( data == 'ok' ){
            muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; El Producto se deshabilitó exitosamente');
            ajaxCargaProductos();
          }
        })
        .fail(function(){
          muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
          console.log('ajaxHabilitaProducto("falló")');
        });
      }

      function ajaxFillFormEdiProductos(id){
        $.ajax({
            data: { "_token": "{{ csrf_token() }}", id, anio:{{Session('anio')}} },
            type: "POST",
            url: "{{ url('../api/almacen/catalogo/getProductoEspecifico') }}"
        })
        .done(function(data){
          console.log('ajaxFillFormEdiProductos(ok)');
          data = $.parseJSON(data);
          var listaCat = '';
          for(var x=0; x<data['lisCat'].length; x++){
            if(data['lisCat'][x]['id'] == data['categoria']){
              listaCat += '<option value="'+data['lisCat'][x]['id']+'" SELECTED>'+data['lisCat'][x]['categoria']+'</option>'
              $("#proUnidades, #proEdiUnidades").html(data['lisCat'][x]['uMedida']+'.');
            } else {
              listaCat += '<option value="'+data['lisCat'][x]['id']+'">'+data['lisCat'][x]['categoria']+'</option>'
            }

          }
          $("#forProEdiCategoria").html(listaCat);
          $("#forProEdiId").val( data['id'] );
          $("#forProEdiLinea").val( data['linea'] );
          //$("#forProEdiCategoria").val( data['categoria'] );
          $("#forProEdiProducto").val( data['producto'] );
          $("#forProEdiMinStock").val( data['minStock'] );
        })
        .fail(function(){
          console.log('ajaxFillFormEdiProductos("falló")');
        });
      }

      function ajaxEdiProducto(){
        $.ajax({
              data: { "_token": "{{ csrf_token() }}", id:$("#forProEdiId").val(), linea:$("#forProEdiLinea").val(),
                      categoria:$("#forProEdiCategoria").val(), producto:$("#forProEdiProducto").val(),
                      minStock:$("#forProEdiMinStock").val(), anio:{{Session('anio')}} },
              type: "POST",
              url: "{{ url('../api/almacen/catalogo/ediProducto') }}"
          })
          .done(function(data){
            console.log('ajaxEdiProducto(ok)');
            if(data == '2'){
              $(".fondoTransparencia, .divForm").hide();
              $('#formEdiProducto')[0].reset();
              muestraAviso('success', '<i class="fas fa-check fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; El Producto fue modificado exitosamente');
              ajaxCargaProductos();
            } else if(data == '1'){
              muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; Este Producto ya fué previamente capturado');
            }
          })
          .fail(function(){
            muestraAviso('', '<i class="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i> &nbsp;&nbsp; No se encuentra la Base de Datos, favor de reintentarlo');
            console.log('ajaxEdiProducto("falló")');
          });
      }
  });
</script>
@STOP
