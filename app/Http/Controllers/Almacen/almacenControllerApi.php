<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Almacen\Lineas_alm;
use App\Modelos\Almacen\Categorias_alm;
use App\Modelos\Almacen\Productos_alm;
use App\Modelos\Almacen\Entradas_alm;
use App\Modelos\Almacen\ListaEntradas_alm;
use App\Modelos\Almacen\Stock_alm;
use App\Modelos\Almacen\SubStock_alm;
use App\Modelos\Almacen\Salidas_alm;
use App\Modelos\Almacen\ListaSalidas_alm;
use App\Modelos\Almacen\Reingresos_alm;
use App\Modelos\Areas;

use App\Modelos\Sicofi\SicProyectos;
use Session;

class almacenControllerApi extends Controller
{
  //     CREADAS DE ACORDE A LA TABLA QUE AFECTAN
  //-------------------------------------------------
  //-- Lineas
    //-- Obtiene la lista de Lineas  -GET
    public function getLineas(){
      $lineas = Lineas_alm:://where('anio', '=', $_POST['anio'])->
        orderBy('linea')->get();
      foreach( $lineas as $linea ){  $data[] = $linea;   }
      if( isset($data) ){
        print_r(json_encode($data));
      } else {
        echo 'empty';
      }
    }

    //-- Agrega una Linea la DB  -GET -POST
    public function addLinea() {
       $linea = Lineas_alm::where('linea', '=', $_POST['linea'])//->where('anio', '=', $_POST['anio'])
       ->first();
       if($linea != ''){
         if( $linea['activo'] == 1 ){
           echo '1';   //linea no capturada
         } else {
           $data = Lineas_alm::where('linea', '=', $_POST['linea'])->update(['activo' => 1]);
           echo '2';   //la linea se reactivo
         }
       } else {
         $data = Lineas_alm::insertGetId(
             ['linea' => $_POST['linea'], 'anio' => $_POST['anio']]
         );
         echo '3';   //la linea se agrego
       }
     }

    //-- Inhabilita una Linea la DB  -POST
    public function inhabilitaLinea(){
       $data = Lineas_alm::where('id', $_POST['id'])->update(['activo' => 0]);
       echo 'ok';
     }

    //-- Habilita una Linea la DB  -POST
    public function habilitaLinea(){
       $data = Lineas_alm::where('id', $_POST['id'])->update(['activo' => 1]);
       echo 'ok';
     }

    //-- Modifica una linea -GET -POST
    public function ediLinea(){
       $flag = 0;
       $lineas = Lineas_alm::where('linea', '=', $_POST['linea'])->get();
       foreach ($lineas as $linea) {
         if($linea['id'] != $_POST['id']){
           $flag = 1;
           break;
         }
       }
       if($flag == 0){
         $data = Lineas_alm::where('id', $_POST['id'])->update(['linea' => $_POST['linea']]);
         echo '0'; //linea actualizada
       } else {
         echo '1'; //linea ya existente
       }
     }

  //-------------------------------------------------
  //-- Categorias
    //-- Agrega una Categoria -GET -POST
    public function addCategoria(){
      $categoria = Categorias_alm::where('categoria', '=', $_POST['categoria'])//->where('anio', '=', $_POST['anio'])
      ->first();
      if($categoria != ''){
        if( $categoria['activo'] == 1 ){
          echo '1';   //Categoria repetida
        } else {
          $data = Categorias_alm::where('categoria', '=', $_POST['categoria'])->update(['activo' => 1]);
          echo '2';   //la Categoría se reactivo
        }
      } else {
        $data = Categorias_alm::insertGetId(
            ['tipo' => $_POST['tipo'], 'categoria' => $_POST['categoria'],
            'linea' => $_POST['linea'], 'uMedida' => $_POST['uMedida'],
            'activo' => 1, 'anio' => $_POST['anio']]
        );
        echo '3';   //la Categoria se agrego
      }
    }

    //-- Obtiene la lista de Categorias  -GET
    public function getCategorias(){
      $categorias = Categorias_alm::join('Lineas_alm', 'Lineas_alm.id', '=', 'Categorias_alm.linea')
                                //->where('Categorias_alm.anio', '=', 2017)
                                ->select('Categorias_alm.id', 'Categorias_alm.tipo', 'Categorias_alm.categoria',
                                  'Categorias_alm.linea as noLinea', 'Lineas_alm.linea', 'Categorias_alm.uMedida',
                                  'Categorias_alm.activo', 'Categorias_alm.anio')
                                ->orderBy('Categorias_alm.categoria')->get();
      foreach( $categorias as $categoria ){  $data[] = $categoria;   }
      if( isset($data) ){
        print_r(json_encode($data));
      } else {
        echo 'empty';
      }
    }

    //-- Habilita una Categoria -POST
    public function habilitaCategoria(){
       $data = Categorias_alm::where('id', $_POST['id'])->update(['activo' => 1]);
       echo 'ok';
    }

    //-- Inhabilita una Categoria -POST
    public function inhabilitaCategoria(){
       $data = Categorias_alm::where('id', $_POST['id'])->update(['activo' => 0]);
       echo 'ok';
    }

    //-- Obtiene los datos de una Categoría -GET
    public function getCategoriaEspecifica(){
      $categorias = Categorias_alm::where('id', '=', $_POST['id'])->first();
      print_r(json_encode($categorias));
    }

    //-- Modifica los datos de una Categoria -GET -POST
    public function ediCategoria(){
      $flag = 0;
      $categorias = Categorias_alm::where('categoria', '=', $_POST['categoria'])//->where('anio', '=', $_POST['anio'])
      ->get();
      foreach ($categorias as $categoria) {
        if($categoria['id'] != $_POST['id']){
          $flag = 1;
          break;
        }
      }
      if($flag == 0){
        $data = Categorias_alm::where('id', $_POST['id'])->update(['tipo' => $_POST['tipo'],
                    'linea' => $_POST['linea'], 'categoria' => $_POST['categoria'],
                    'uMedida' => $_POST['uMedida'] ]);
        echo '2'; //linea actualizada
      } else {
        echo '1'; //linea ya existente
      }
    }

    //-- Obtiene la lista de Categorias con X Linea  -GET
    public function getCategoriasXLinea(){
      $categorias = Categorias_alm:://where('anio', '=', $_POST['anio'])->
            where('activo', '=', 1)->where('linea', '=', $_POST['linea'])
                                ->orderBy('categoria')->get();
      foreach( $categorias as $categoria ){  $data[] = $categoria;   }
      if( isset($data) ){
        print_r(json_encode($data));
      } else {
        echo 'empty';
      }
    }

  //-------------------------------------------------
  //-- Productos
    //-- Agrega un Producto -GET -POST
    public function addProducto(){
      $producto = Productos_alm::where('producto', '=', $_POST['producto'])//->where('anio', '=', $_POST['anio'])
      ->first();
      if($producto != ''){
        if( $producto['activo'] == 1 ){
          echo '1';   //Producto repetido
        } else {
          $data = Productos_alm::where('producto', '=', $_POST['producto'])->update(['activo' => 1]);
          echo '2';   //El Producto se reactivo
        }
      } else {
        $data = Productos_alm::insertGetId(
            ['linea' => $_POST['linea'], 'categoria' => $_POST['categoria'],
            'producto' => $_POST['producto'], 'minStock' => $_POST['minStock'], 'activo' => 1, 'anio' => $_POST['anio']]
        );
        echo '3';   //El Producto se agrego
      }
    }

    //-- Obtiene la lista de productos
    public function getProductos(){
      $productos = Productos_alm::join('Lineas_alm', 'Lineas_alm.id', '=', 'Productos_alm.linea')
                              ->join('Categorias_alm', 'Categorias_alm.id', '=', 'Productos_alm.categoria')
                                //->where('Productos_alm.anio', '=', $_POST['anio'])
                                ->select('Productos_alm.id', 'Lineas_alm.linea', 'Productos_alm.categoria as noCategoria',
                                  'Categorias_alm.categoria', 'Productos_alm.producto', 'Categorias_alm.uMedida',
                                  'Productos_alm.minStock', 'Productos_alm.activo')
                                ->orderBy('Productos_alm.producto')->get();
      foreach( $productos as $producto ){  $data[] = $producto;   }
      if( isset($data) ){
        print_r(json_encode($data));
      } else {
        echo 'empty';
      }
    }

    //-- Habilita un Producto -POST
    public function habilitaProducto(){
       $data = Productos_alm::where('id', $_POST['id'])->update(['activo' => 1]);
       echo 'ok';
    }

    //-- Inhabilita un Producto -POST
    public function inhabilitaProducto(){
       $data = Productos_alm::where('id', $_POST['id'])->update(['activo' => 0]);
       echo 'ok';
    }

    //-- Obtiene los datos de un Producto  -GET
    public function getProductoEspecifico(){
      $productos = Productos_alm::where('id', '=', $_POST['id'])->first();
      $categorias = Categorias_alm::where('linea', '=', $productos['linea'])->get();
      $productos['lisCat'] = $categorias;
      print_r(json_encode($productos));
    }

    //-- Modifica los datos de un Producto -GET -POST
    public function ediProducto(){
      $flag = 0;
      $productos = Productos_alm::where('producto', '=', $_POST['producto'])//->where('anio', '=', $_POST['anio'])
      ->get();
      foreach ($productos as $producto) {
        if($producto['id'] != $_POST['id']){
          $flag = 1;
          break;
        }
      }
      if($flag == 0){
        $data = Productos_alm::where('id', $_POST['id'])->update(['linea' => $_POST['linea'],
                    'categoria' => $_POST['categoria'], 'producto' => $_POST['producto'],
                    'minStock' => $_POST['minStock'] ]);
        echo '2'; //producto actualizada
      } else {
        echo '1'; //producto ya existente
      }
    }

  //-------------------------------------------------
  //-- Entradas
    //-- Agrega una entrada a la DB STOCK/ENTRADAS
    public function addEntrada(){
      //guarda entrada
      $data = Entradas_alm::insertGetId(
          ['tipo' => $_POST['tipo'], 'folioFactura' => $_POST['folioFactura'],
          'fechaFactura' => $_POST['fechaFactura'], 'monto' => $_POST['monto'],
          'fechaIngreso' => $_POST['fechaIngreso'], 'obs' => $_POST['obs'], 'anio' => $_POST['anio']]
      );
      //obten no. de entrada
      $noItem = Entradas_alm::select('id')->orderBy('id', 'desc')->first();
      $noItem = $noItem['id'];
      //guarda listaEntrada
      $listaEntradas = json_decode( $_POST['listaEntradas'] );
      for($x=0; $x<count($listaEntradas); $x++){
        $data = ListaEntradas_alm::insertGetId(
            ['noEntrada' => $noItem, 'producto' => $listaEntradas[$x]->producto,
            'categoria' => $listaEntradas[$x]->categoria, 'linea' => $listaEntradas[$x]->linea,
            'cantidad' => $listaEntradas[$x]->cantidad, 'noControl' => $listaEntradas[$x]->noControl,
            'noSerie' => $listaEntradas[$x]->noSerie, 'marca' => $listaEntradas[$x]->marca,
            'modelo' => $listaEntradas[$x]->modelo, 'obs' => $listaEntradas[$x]->obs,
            'ubicacion' => $listaEntradas[$x]->ubicacion, 'anio' => $_POST['anio']]
        );
        //añade STOCK
        $noProd = Stock_alm::where('producto', '=', $listaEntradas[$x]->producto)->first();
        $isTipo = Categorias_alm::where('id', '=', $listaEntradas[$x]->categoria)->first();
       if( isset($noProd['id']) ){  //si el producto ya existe
          $datax = Stock_alm::where('producto', '=', $listaEntradas[$x]->producto)
            ->update(['stock' => ($noProd['stock'] + $listaEntradas[$x]->cantidad), 'disponible' => ($noProd['disponible'] + $listaEntradas[$x]->cantidad)]);
          if($isTipo['tipo'] == 'BII'){
            $datax = subStock_alm::insertGetId([
              'producto' => $listaEntradas[$x]->producto, 'noControl' => $listaEntradas[$x]->noControl,
              'noSerie' => $listaEntradas[$x]->noSerie, 'marca' => $listaEntradas[$x]->marca,
              'modelo' => $listaEntradas[$x]->modelo, 'obs' => $listaEntradas[$x]->obs,
              'ubicacion' => $listaEntradas[$x]->ubicacion, 'anio' => $_POST['anio']
            ]);
          }
       } else { // si el producto aun no existe
         if($isTipo['tipo'] == 'CON' || $isTipo['tipo'] == 'BIN'){ // si el producto es CON (consumible) BIN (bien no inventariable)
           $datax = Stock_alm::insertGetId([
             'producto' => $listaEntradas[$x]->producto, 'categoria' => $listaEntradas[$x]->categoria,
             'linea' => $listaEntradas[$x]->linea, 'stock' => $listaEntradas[$x]->cantidad,
             'disponible' => $listaEntradas[$x]->cantidad, 'noDisponible' => 0,
             'activo' => 1, 'anio' => $_POST['anio'], 'sub' => 0
           ]);
         } else { // si el producto es un bien BII (Bien inventariable)
           $datax = Stock_alm::insertGetId([
             'producto' => $listaEntradas[$x]->producto, 'categoria' => $listaEntradas[$x]->categoria,
             'linea' => $listaEntradas[$x]->linea, 'stock' => $listaEntradas[$x]->cantidad,
             'disponible' => $listaEntradas[$x]->cantidad, 'noDisponible' => 0,
             'activo' => 1, 'anio' => $_POST['anio'], 'sub' => 1
           ]);
           //agrega a la lista subStock
           $datax = subStock_alm::insertGetId([
             'producto' => $listaEntradas[$x]->producto, 'noControl' => $listaEntradas[$x]->noControl,
             'noSerie' => $listaEntradas[$x]->noSerie, 'marca' => $listaEntradas[$x]->marca,
             'modelo' => $listaEntradas[$x]->modelo, 'obs' => $listaEntradas[$x]->obs,
             'ubicacion' => $listaEntradas[$x]->ubicacion, 'anio' => $_POST['anio']
           ]);
         }
       }
     }
    }

    //-- Obtiene las Entradas con su lista de productos
    public function getEntradas(){
      $data = Entradas_alm::where('anio', '=', $_POST['anio'])->orderBy('id', 'desc')->get();
      if( isset($data) ){
        for($x = 0; $x < count($data); $x++){
          $data[$x]['listaEntrada'] = ListaEntradas_alm::where('listaEntradas_alm.noEntrada', '=', $data[$x]['id'])
          ->join('Productos_alm', 'Productos_alm.id', '=', 'ListaEntradas_alm.producto')
          ->join('Categorias_alm', 'Categorias_alm.id', '=', 'ListaEntradas_alm.categoria')
          ->join('Lineas_alm', 'Lineas_alm.id', '=', 'ListaEntradas_alm.linea')
          ->select('ListaEntradas_alm.id as id', 'ListaEntradas_alm.noEntrada as noEntrada',
            'ListaEntradas_alm.producto', 'ListaEntradas_alm.categoria', 'ListaEntradas_alm.linea',
            'Productos_alm.producto as nomProducto', 'Categorias_alm.categoria as nomCategoria',
            'Categorias_alm.uMedida', 'Lineas_alm.linea as nomLinea', 'ListaEntradas_alm.cantidad as cantidad',
            'ListaEntradas_alm.noControl as noControl', 'ListaEntradas_alm.noSerie', 'ListaEntradas_alm.marca',
            'ListaEntradas_alm.modelo', 'ListaEntradas_alm.obs as listaObs','ListaEntradas_alm.ubicacion',
            'ListaEntradas_alm.anio as listaAnio')
          ->orderBy('listaEntradas_alm.id')->get();
        }
        print_r(json_encode($data));
      } else {
        echo 'empty';
      }
    }

    //-- Elimina una entrada de la lista de productos
    public function delEntrada(){
      $flag = [];    //indica el status de la entrada para saber si es eliminable o no
                        //status de flag    0: ok (eliminable)
                                          //1: no eliminable (hay menos disponibles que la entrada)
                                          //2: no eliminable (alguno de los productos de la entrada estan prestados actualmente)
      $msg = [];    //en caso de haber algun problema con la eliminacion nos indica en que producto y por que
      //busca los productos de la entrada
      $listaEntrada = ListaEntradas_alm::where('noEntrada', '=', $_POST['id'])
      ->join('Categorias_alm', 'Categorias_alm.id', '=', 'ListaEntradas_alm.categoria')
      ->join('Productos_alm', 'Productos_alm.id', '=', 'ListaEntradas_alm.producto')
      ->select('ListaEntradas_alm.id', 'ListaEntradas_alm.noEntrada', 'Listaentradas_alm.producto',
          'Categorias_alm.tipo', 'ListaEntradas_alm.noControl', 'ListaEntradas_alm.cantidad', 'Productos_alm.producto as nombreProducto')->get();
      //para cada elemento de la lista
      for($x=0; $x<count($listaEntrada); $x++){
        //obtenemos los datos en el Stock para este producto [x]
        $listaStock[ $listaEntrada[$x]['producto'] ] = Stock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->first();
        //si es un Bien inventariable obtenemos los datos del subStock sino, solo creamos la entrada vacia
        if( $listaEntrada[$x]['tipo'] == 'CON' || $listaEntrada[$x]['tipo'] == 'BIN' ){
          $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'] = [];
        } else if( $listaEntrada[$x]['tipo'] == 'BII' ){
          $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'] = SubStock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->get();
        }

        //revisamos si son eliminables      (este proceso lo separo del anterior "IF" para que sea mas facilmente identificable)
        //en caso de ser CON o BIN  solo se revisa que su resta (stock.disponible - entrada.cantidad) no sea menor a cero
        if( $listaEntrada[$x]['tipo'] == 'CON' || $listaEntrada[$x]['tipo'] == 'BIN' ){
          //si es menor a cero, guardamos alerta
          if( ($listaStock[ $listaEntrada[$x]['producto'] ]['disponible'] - $listaEntrada[$x]['cantidad']) < 0){
            $flag[] = 1;
            $msg[] = 'No puedes eliminar esta entrada, la cantidad de "'.$listaEntrada[$x]['nombreProducto'].'" diponibles será menor a cero';
          }
          //en caso de ser BII
        } else if( $listaEntrada[$x]['tipo'] == 'BII' ){
          //revisaremos la lista de subStock para este producto
          for($y=0; $y<count($listaStock[ $listaEntrada[$x]['producto'] ]['listaSub']); $y++){
            //Si el no control coincide y este subStock no esta disponible (guarda alerta)
            if( $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'][$y]['noControl'] ==  $listaEntrada[$x]['noControl'] &&
            $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'][$y]['disp'] == 0){
                $flag[] = 2;
                $msg[] = 'No puedes eliminar esta entrada, el producto "'.$listaEntrada[$x]['nombreProducto'].'" con # de control "'.$listaEntrada[$x]['noControl'].'" no está disponible actualmente';
            }
          }
        }
      }

      //-- una vez terminada la validación revisamos si hay mensajes de error
      if(count($flag) == 0){  //sin alertas (procede a eliminar)
        //recorremos los elementos de la entrada
        for($x=0; $x<count($listaEntrada); $x++){
          //si es CON o BIN actualizamos con la resta de entrada.cantidad a stock.dips, stock.stock
          if( $listaEntrada[$x]['tipo'] == 'CON' || $listaEntrada[$x]['tipo'] == 'BIN' ){
            $query = Stock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->update([
              'stock' => ($listaStock[ $listaEntrada[$x]['producto'] ]['stock'] - $listaEntrada[$x]['cantidad']),
              'disponible' => ($listaStock[ $listaEntrada[$x]['producto'] ]['disponible'] - $listaEntrada[$x]['cantidad'])
            ]);
          } else if( $listaEntrada[$x]['tipo'] == 'BII' ){    //si es un BII
            //revisaremos la lista de subStock para este producto
            for($y=0; $y<count($listaStock[ $listaEntrada[$x]['producto'] ]['listaSub']); $y++){
              //Si el no control coincide con este subStock elimina el objeto
              if( $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'][$y]['noControl'] ==  $listaEntrada[$x]['noControl'] ){
                SubStock_alm::where('producto', '=', $listaEntrada[$x]['producto'])
                  ->where('noControl', '=', $listaEntrada[$x]['noControl'])->delete();
              }
              //actualizamos el stock.disp y el stock.stock
              $query = Stock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->update([
                'stock' => ($listaStock[ $listaEntrada[$x]['producto'] ]['stock'] - $listaEntrada[$x]['cantidad']),
                'disponible' => ($listaStock[ $listaEntrada[$x]['producto'] ]['disponible'] - $listaEntrada[$x]['cantidad'])
              ]);
            }
          }
          //echo 'ENTRADA - x: '.$x.', producto: '.$listaEntrada[$x]['producto'].'-'.$listaEntrada[$x]['nombreProducto'].', cantidad: '.$listaEntrada[$x]['cantidad'].'<br>';
          //echo 'STOCK - stock: '.$listaStock[ $listaEntrada[$x] ['producto']]['stock'].', disponible: '.$listaStock[ $listaEntrada[$x] ['producto']]['disponible'].'<br>';
          //resta
          $listaStock[ $listaEntrada[$x] ['producto']]['stock'] -= $listaEntrada[$x]['cantidad'];
          $listaStock[ $listaEntrada[$x] ['producto']]['disponible'] -= $listaEntrada[$x]['cantidad'];
          //echo 'FINAL - stock: '.$listaStock[ $listaEntrada[$x] ['producto']]['stock'].', disponible: '.$listaStock[ $listaEntrada[$x] ['producto']]['disponible'].'<br>';
        }
        //echo '<br><br>';
        //eliminamos los datos de la entrada
        Entradas_alm::where('id', '=', $_POST['id'])->delete();
        listaEntradas_alm::where('noEntrada', '=', $_POST['id'])->delete();
        //enviamos confirmación final
        echo 'ok';
      } else if(count($msg) > 0) { //enviamos las alertas a la pagina para ser mostradas
        $respuesta = $msg;
        print_r( json_encode($respuesta) );
      }
    }

    //-- Modifica una Entradas_alm
    public function ediEntrada(){
      //print_r($_POST);

      //-- OBTENCION DE DATOS --------------------
        //genero tres arrays (1)productos viejos, (2)productos nuevos, (3)productos en stock con estos arrays comprobaré si los items son editables o no
        $arrayComparativo = [];

        //--Entradas Viejas
        $query = ListaEntradas_alm::where('noEntrada', '=', $_POST['id'])->get();
        foreach ($query as $item) {
          if($item['noControl'] == "0"){        //Si es CON o BIN le asignamos un numero del Arreglo
            $arrayComparativo[ $item['producto'] ]['viejo'] = $item['cantidad'];
            $arrayComparativo[ $item['producto'] ]['sub'] = 0;
          } else if($item['noControl'] != "0"){       //Si es BII lo asignamos a un inciso de su numero en el arreglo
            if( !isset($arrayComparativo[ $item['producto'] ]['viejo']) ){
              $arrayComparativo[ $item['producto'] ]['viejo'] = [];
            }
            $arrayComparativo[ $item['producto'] ]['viejo'][] = $item['noControl'];
            $arrayComparativo[ $item['producto'] ]['sub'] = 1;
          }
        }

        //--Entradas Nuevas
        $obj = json_decode( $_POST['listaEntradas'] );
        foreach ( $obj as $item) {
          //print_r($item->noControl);
          if($item->noControl == "0"){
            $arrayComparativo[ $item->producto ]['nuevo'] = $item->cantidad;
            $arrayComparativo[ $item->producto ]['sub'] = 0;
          }  else if( $item->noControl != "0" ){       //Si es BII lo asignamos a un inciso de su numero en el arreglo
            if( !isset($arrayComparativo[ $item->producto ]['nuevo']) ){
              $arrayComparativo[ $item->producto ]['nuevo'] = [];
            }
            $arrayComparativo[ $item->producto ]['nuevo'][] = $item->noControl;
            $arrayComparativo[ $item->producto ]['sub'] = 1;
          }
        }

        //recorremos el "arrayComparativo" rellenando huecos y obteniendo los datos del stock y subStock
        foreach ($arrayComparativo as $key => $value) {
          switch (true) {       //rellenamos espacios vacios
            case ( $value['sub'] == 0 && !isset($value['viejo']) ):
              $arrayComparativo[$key]['viejo'] = 0;
            break;
            case ( $value['sub'] == 0 && !isset($value['nuevo']) ):
              $arrayComparativo[$key]['nuevo'] = 0;
            break;
            case ( $value['sub'] == 1 && !isset($value['viejo']) ):
              $arrayComparativo[$key]['viejo'] = [];
            break;
            case ( $value['sub'] == 1 && !isset($value['nuevo']) ):
              $arrayComparativo[$key]['nuevo'] = [];
            break;
          }

          //obtenemos valores del stock y substock
          $query = Stock_alm::where('producto', '=', $key)->first();
          $arrayComparativo[$key]['stock'] = [];
          if( !isset($query['sub']) ){   // si no existe en el stock no hay problema puede se rmodificado puesto que no se ha registrado entrada o salida con este producto
            $arrayComparativo[$key]['stock']['disponible'] = 0;
          } else if( $query['sub'] == 0){   // si este producto es CON o BIN (no tiene subStock) almacenamos el disponible para el calculo
            $arrayComparativo[$key]['stock']['disponible'] = $query['disponible'];
          } else if( $query['sub'] == 1 ){    // si este producto es BII guardaremos la disponibilidad de cada item (por no. de control)
            $subQuery = subStock_alm::where('producto', '=', $key)->get();
            $arrayComparativo[$key]['stock']['sub'] = [];
            for($x=0; $x<count($subQuery); $x++){
              $arrayComparativo[$key]['stock']['sub'][ $subQuery[$x]['noControl'] ] = $subQuery[$x]['disp'];
            }
          }

        }

      //-- VALIDACIÓN DE DATOS --------------------
        //-- recorremos el array y validamos si se puede modifivar
        $avisos = [];  // guarda los mensajes
        foreach ($arrayComparativo as $key => $value){  //recorremos el arreglo y validamos
          if( $arrayComparativo[$key]['sub'] == 0 ){  //  si el item es CON o BIN
            if( (($arrayComparativo[$key]['stock']['disponible'] - $arrayComparativo[$key]['viejo']) + $arrayComparativo[$key]['nuevo']) < 0 ){   //revisamos si al modificar el disponible no será menor a cero
              $nombreProducto = Productos_alm::where('id', '=', $key)->select('producto')->first();     //obtenemos el nombre del producto
              $avisos[] = 'No se puede modificar, el stock disponible de "'.$nombreProducto['producto'].'" sería menor a cero';
            }
          } else if( $arrayComparativo[$key]['sub'] == 1 ) {    // si el item es BIi
              //revisamos si el item con noControl [x] de la vieja entrada se encuentra en la nueva
              for($x = 0; $x < count($arrayComparativo[$key]['viejo']); $x++){
                if( !in_array( $arrayComparativo[$key]['viejo'][$x], $arrayComparativo[$key]['nuevo'] )   ){     // si no esta revisamos si esta disponible
                  if( $arrayComparativo[$key]['stock']['sub'][ $arrayComparativo[$key]['viejo'][$x] ] == 0 ){   //en caso de no estar disponible cremaos alerta
                    $nombreProducto = Productos_alm::where('id', '=', $key)->select('producto')->first();     //obtenemos el nombre del producto
                    $avisos[] = 'No se puede modificar, "'.$nombreProducto['producto'].'" con # de control "'.$arrayComparativo[$key]['viejo'][$x].'" no esta disponible actualmente';
                  }
                }
              }
          }
        }

      //-- EJECUTAMOS LA MODIFICACION (si no hay avisos de error) --------------------
      if( count($avisos) == 0 ){
        // ELIMINAREMOS LOS DATOS DE LA ENTRADA --------------------
        $listaEntrada = ListaEntradas_alm::where('noEntrada', '=', $_POST['id'])
        ->join('Categorias_alm', 'Categorias_alm.id', '=', 'ListaEntradas_alm.categoria')
        ->join('Productos_alm', 'Productos_alm.id', '=', 'ListaEntradas_alm.producto')
        ->select('ListaEntradas_alm.id', 'ListaEntradas_alm.noEntrada', 'Listaentradas_alm.producto',
            'Categorias_alm.tipo', 'ListaEntradas_alm.noControl', 'ListaEntradas_alm.cantidad', 'Productos_alm.producto as nombreProducto')->get();
        //para cada elemento de la lista
        for($x=0; $x<count($listaEntrada); $x++){
          //obtenemos los datos en el Stock para este producto [x]
          $listaStock[ $listaEntrada[$x]['producto'] ] = Stock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->first();
          //si es un Bien inventariable obtenemos los datos del subStock sino, solo creamos la entrada vacia
          if( $listaEntrada[$x]['tipo'] == 'CON' || $listaEntrada[$x]['tipo'] == 'BIN' ){
            $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'] = [];
          } else if( $listaEntrada[$x]['tipo'] == 'BII' ){
            $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'] = SubStock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->get();
          }
        }

        //recorremos los elementos de la entrada
        for($x=0; $x<count($listaEntrada); $x++){
          //si es CON o BIN actualizamos con la resta de entrada.cantidad a stock.dips, stock.stock
          if( $listaEntrada[$x]['tipo'] == 'CON' || $listaEntrada[$x]['tipo'] == 'BIN' ){
            $query = Stock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->update([
              'stock' => ($listaStock[ $listaEntrada[$x]['producto'] ]['stock'] - $listaEntrada[$x]['cantidad']),
              'disponible' => ($listaStock[ $listaEntrada[$x]['producto'] ]['disponible'] - $listaEntrada[$x]['cantidad'])
            ]);
          } else if( $listaEntrada[$x]['tipo'] == 'BII' ){    //si es un BII
            //revisaremos la lista de subStock para este producto
            for($y=0; $y<count($listaStock[ $listaEntrada[$x]['producto'] ]['listaSub']); $y++){
              //Si el no control coincide con este subStock elimina el objeto
              if( $listaStock[ $listaEntrada[$x]['producto'] ]['listaSub'][$y]['noControl'] ==  $listaEntrada[$x]['noControl'] ){
                SubStock_alm::where('producto', '=', $listaEntrada[$x]['producto'])
                  ->where('noControl', '=', $listaEntrada[$x]['noControl'])->delete();
              }
              //actualizamos el stock.disp y el stock.stock
              $query = Stock_alm::where('producto', '=', $listaEntrada[$x]['producto'])->update([
                'stock' => ($listaStock[ $listaEntrada[$x]['producto'] ]['stock'] - $listaEntrada[$x]['cantidad']),
                'disponible' => ($listaStock[ $listaEntrada[$x]['producto'] ]['disponible'] - $listaEntrada[$x]['cantidad'])
              ]);
            }
          }
          //resta
          $listaStock[ $listaEntrada[$x] ['producto']]['stock'] -= $listaEntrada[$x]['cantidad'];
          $listaStock[ $listaEntrada[$x] ['producto']]['disponible'] -= $listaEntrada[$x]['cantidad'];
        }
        //echo '<br><br>';
        //eliminamos los datos de la lista de imtes de la entrada
        listaEntradas_alm::where('noEntrada', '=', $_POST['id'])->delete();

        //actualizamos los datos de la entrada acutal --------------------
        $data = Entradas_alm::where( 'id', '=', $_POST['id'] )->update([
          'folioFactura' => ( $_POST['folioFactura'] ),
          'fechaFactura' => ( $_POST['fechaFactura'] ),
          'monto' => ( $_POST['monto'] ),
          'fechaIngreso' => ( $_POST['fechaIngreso'] ),
          'obs' => ( $_POST['obs'] )
        ]);

        //guardamos nueva lista de productos y actualizamos el STOCK
        //guarda listaEntrada
        $listaEntradas = json_decode( $_POST['listaEntradas'] );
        for($x=0; $x<count($listaEntradas); $x++){
          $data = ListaEntradas_alm::insertGetId(
              ['noEntrada' => $_POST['id'], 'producto' => $listaEntradas[$x]->producto,
              'categoria' => $listaEntradas[$x]->categoria, 'linea' => $listaEntradas[$x]->linea,
              'cantidad' => $listaEntradas[$x]->cantidad, 'noControl' => $listaEntradas[$x]->noControl,
              'noSerie' => $listaEntradas[$x]->noSerie, 'marca' => $listaEntradas[$x]->marca,
              'modelo' => $listaEntradas[$x]->modelo, 'obs' => $listaEntradas[$x]->obs,
              'ubicacion' => $listaEntradas[$x]->ubicacion, 'anio' => $_POST['anio']]
          );
          //añade STOCK
          $noProd = Stock_alm::where('producto', '=', $listaEntradas[$x]->producto)->first();
          $isTipo = Categorias_alm::where('id', '=', $listaEntradas[$x]->categoria)->first();
         if( isset($noProd['id']) ){  //si el producto ya existe
            $datax = Stock_alm::where('producto', '=', $listaEntradas[$x]->producto)
              ->update(['stock' => ($noProd['stock'] + $listaEntradas[$x]->cantidad), 'disponible' => ($noProd['disponible'] + $listaEntradas[$x]->cantidad)]);
            if($isTipo['tipo'] == 'BII'){
              $datax = subStock_alm::insertGetId([
                'producto' => $listaEntradas[$x]->producto, 'noControl' => $listaEntradas[$x]->noControl,
                'noSerie' => $listaEntradas[$x]->noSerie, 'marca' => $listaEntradas[$x]->marca,
                'modelo' => $listaEntradas[$x]->modelo, 'obs' => $listaEntradas[$x]->obs,
                'ubicacion' => $listaEntradas[$x]->ubicacion, 'anio' => $_POST['anio']
              ]);
            }
         } else { // si el producto aun no existe
           if($isTipo['tipo'] == 'CON' || $isTipo['tipo'] == 'BIN'){ // si el producto es CON (consumible) BIN (bien no inventariable)
             $datax = Stock_alm::insertGetId([
               'producto' => $listaEntradas[$x]->producto, 'categoria' => $listaEntradas[$x]->categoria,
               'linea' => $listaEntradas[$x]->linea, 'stock' => $listaEntradas[$x]->cantidad,
               'disponible' => $listaEntradas[$x]->cantidad, 'noDisponible' => 0,
               'activo' => 1, 'anio' => $_POST['anio'], 'sub' => 0
             ]);
           } else { // si el producto es un bien BII (Bien inventariable)
             $datax = Stock_alm::insertGetId([
               'producto' => $listaEntradas[$x]->producto, 'categoria' => $listaEntradas[$x]->categoria,
               'linea' => $listaEntradas[$x]->linea, 'stock' => $listaEntradas[$x]->cantidad,
               'disponible' => $listaEntradas[$x]->cantidad, 'noDisponible' => 0,
               'activo' => 1, 'anio' => $_POST['anio'], 'sub' => 1
             ]);
             //agrega a la lista subStock
             $datax = subStock_alm::insertGetId([
               'producto' => $listaEntradas[$x]->producto, 'noControl' => $listaEntradas[$x]->noControl,
               'noSerie' => $listaEntradas[$x]->noSerie, 'marca' => $listaEntradas[$x]->marca,
               'modelo' => $listaEntradas[$x]->modelo, 'obs' => $listaEntradas[$x]->obs,
               'ubicacion' => $listaEntradas[$x]->ubicacion, 'anio' => $_POST['anio']
             ]);
           }
         }
       }
       echo 'ok';
      } else {      // si hay avisos los mandamos al sistema
        print_r(json_encode($avisos));
      }
    }

  //-------------------------------------------------
  //-- ListaEntradas
    //-- Obtiene los productos de una entrada especificia
    public function getEntProductos(){
      $listaEntradas = ListaEntradas_alm::where('listaEntradas_alm.noEntrada', '=', $_POST['id'])
        ->join('Productos_alm', 'Productos_alm.id', '=', 'ListaEntradas_alm.producto')
        ->join('Categorias_alm', 'Categorias_alm.id', '=', 'ListaEntradas_alm.categoria')
        ->join('Lineas_alm', 'Lineas_alm.id', '=', 'ListaEntradas_alm.linea')
        ->select('ListaEntradas_alm.id as id', 'ListaEntradas_alm.noEntrada as noEntrada',
          'Productos_alm.producto as nomProducto', 'Categorias_alm.categoria as nomCategoria',
          'Categorias_alm.uMedida', 'Lineas_alm.linea as nomLinea', 'ListaEntradas_alm.cantidad as cantidad',
          'ListaEntradas_alm.noControl as noControl')
        ->get();
      print_r(json_encode($listaEntradas));
    }

  //-------------------------------------------------
  //-- Stock
    //-- Obtiene la lista completa de productos con Stock
    public function getFullStock(){
      $fullList = Productos_alm:://where('Productos_alm.anio', '=', $_POST['anio'])->
      join('Categorias_alm', 'Categorias_alm.id', '=', 'Productos_alm.categoria')
      ->join('Lineas_alm', 'Lineas_alm.id', '=', 'Productos_alm.linea')
      ->select('Productos_alm.id', 'Lineas_alm.linea', 'Categorias_alm.tipo', 'Categorias_alm.categoria',
                'Categorias_alm.uMedida', 'Productos_alm.minStock', 'Productos_alm.producto',
                'Lineas_alm.activo AS LinActivo', 'Categorias_alm.activo AS catActivo', 'Productos_alm.activo AS prodActivo')->get();

      for($x=0; $x<count($fullList); $x++){
          $fullList[$x]['datosStock'] = Stock_alm::where('producto', '=', $fullList[$x]['id'])
                                        //->where('anio', '=', $_POST['anio'])
                                        ->first();

          if($fullList[$x]['datosStock']['sub'] == 1){
            $fullList[$x]['datosStock']['listaStock'] = SubStock_alm::where('producto', '=', $fullList[$x]['id'])
                                                        //->where('anio', '=', $_POST['anio'])
                                                        ->get();
          }
      }
      print_r( json_encode($fullList) );
    }

    //-- Obtiene la lista de Lineas en Stock
    public function getStockLineas(){
      $stock = Stock_alm::join('Lineas_alm', 'Stock_alm.linea', '=', 'Lineas_alm.id')
        ->select('Stock_alm.linea AS noLinea', 'Lineas_alm.linea AS nomLinea')
        ->orderBy('nomLinea')
        ->groupBy('noLinea')
        ->get();
      if( isset($stock) ){
        print_r(json_encode($stock));
      } else {
        echo 'empty';
      }
    }

    //-- Obtiene la lista de categorias en Stock
    public function getStockCategorias(){
      $stock = Stock_alm::join('Categorias_alm', 'Stock_alm.categoria', '=', 'Categorias_alm.id')
        ->select('Stock_alm.categoria AS noCategoria', 'Categorias_alm.categoria AS nomCategoria')
        ->orderBy('nomCategoria')->groupBy('noCategoria')
        ->where('Stock_alm.linea', '=', $_POST['id'])->get();
      if( isset($stock) ){
        print_r(json_encode($stock));
      } else {
        echo 'empty';
      }
    }

    //-- Obtiene la lista de productos en Stock
    public function getStockProductos(){
      //print_r($_POST);
      $stock = Stock_alm::join('Productos_alm', 'Stock_alm.producto', '=', 'Productos_alm.id')
      ->select('Stock_alm.producto AS noProducto', 'Productos_alm.producto AS nomProducto')
      ->orderBy('nomProducto')->groupBy('noProducto')
      ->where('Stock_alm.disponible', '>', '0')
      ->where('Stock_alm.categoria', '=', $_POST['id'])->get();
      if( isset($stock) ){
        print_r(json_encode($stock));
      } else {
        echo 'empty';
      }
    }

  //-------------------------------------------------
  //-- subStock
    //-- Obtiene los datos de un producto en subStock
    public function canProdBeAdd(){
      $categoria = Categorias_alm::where('id', '=', $_POST['categoria'])->first();
      if($categoria['tipo'] == 'BII'){
        $subStock = SubStock_alm::where('producto', '=', $_POST['producto'])
            ->where('noControl', '=', $_POST['noControl'])
            //->where('anio', '=', $_POST['anio'])
            ->first();
        if($subStock == '' && $_POST['noControl'] != "0"){
          echo 'ok';
        } else {
          echo 'ya existe';
        }
      } else if( $categoria['tipo'] == 'CON' || $categoria['tipo'] == 'BIN') {
        echo 'ok';
      }
    }

    //-- oObtiene la lisa de subStock para X producto
    public function testProdStock(){
      $stock = Stock_alm::where('producto', '=', $_POST['id'])->first();
      if($stock != null){
        if($stock['sub'] == 1){
          $stock['listaStock'] = SubStock_alm::where('producto', '=', $_POST['id'])
                //->where('anio', '=', $_POST['anio'])
                ->get();
        }
        print_r(json_encode($stock));
      } else {
        echo 'empty';
      }
    }

  //-------------------------------------------------
  //-- Salidas
    //-- guarda Salida y actualiza Stock
    public function addSalida(){
      $listaSalidas = json_decode($_POST['listaSalidas']);  //obtenems la lista de productos que salen
      //guarda Salida
      $data = Salidas_alm::insertGetId([
        'fechaSalida' => $_POST['fechaSalida'], 'noArea' => $_POST['noArea'],
        'nomSol' => $_POST['nomSol'], 'fechaDev' => $_POST['fechaDev'],
        'destino' => $_POST['destino'], 'obs' => $_POST['obs'], 'anio' => $_POST['anio']
      ]);
      //obten no. de Salida
      $noItem = Salidas_alm::select('id')->orderBy('id', 'desc')->first();
      $noItem = $noItem['id'];


      for($x=0; $x<count($listaSalidas); $x++){
        //guarda listaSalidas
        $data = ListaSalidas_alm::insertGetId([
          'noSalida' => $noItem, 'producto' => $listaSalidas[$x]->producto,
          'categoria' => $listaSalidas[$x]->categoria, 'linea' => $listaSalidas[$x]->linea,
          'cantidad' => $listaSalidas[$x]->cantidad, 'noControl' => $listaSalidas[$x]->noControl,
          'noSerie' => $listaSalidas[$x]->noSerie, 'marca' => $listaSalidas[$x]->marca,
          'modelo' => $listaSalidas[$x]->modelo, 'obs' => $listaSalidas[$x]->obs,
          'ubicacion' => $listaSalidas[$x]->ubicacion, 'anio' => $_POST['anio']
        ]);

        // UPDATES AL ALMACEN
        if( $listaSalidas[$x]->tipo == 'CON'){
          //update STOCK
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->select('stock', 'disponible', 'noDisponible')->first(); //obtenemos stock actual
          $stock = $data['stock'];  $disponible = $data['disponible'];    $noDisponible = $data['noDisponible'];
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->update([
            'stock' => ( $stock - $listaSalidas[$x]->cantidad ),
            'disponible' => ( $disponible - $listaSalidas[$x]->cantidad )
          ]);
        } else if( $listaSalidas[$x]->tipo == 'BIN' ){
          //update STOCK
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->select('stock', 'disponible', 'noDisponible')->first(); //obtenemos stock actual
          $stock = $data['stock'];  $disponible = $data['disponible'];    $noDisponible = $data['noDisponible'];
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->update([
            'disponible' => ( $disponible - $listaSalidas[$x]->cantidad ),
            'noDisponible' => ( $noDisponible + $listaSalidas[$x]->cantidad )
          ]);
        } else if( $listaSalidas[$x]->tipo == 'BII' ) {
          //update STOCK
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->select('stock', 'disponible', 'noDisponible')->first(); //obtenemos stock actual
          $stock = $data['stock'];  $disponible = $data['disponible'];    $noDisponible = $data['noDisponible'];
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->update([
            'disponible' => ( $disponible - $listaSalidas[$x]->cantidad ),
            'noDisponible' => ( $noDisponible + $listaSalidas[$x]->cantidad )
          ]);

          //update subSTOCK si tipo = BIEN INVENTARIABLE
          $data = SubStock_alm::where('producto', '=', $listaSalidas[$x]->producto)
            ->where('noControl', '=', $listaSalidas[$x]->noControl)
            //->where('anio', '=', $_POST['anio'])
            ->update([ 'disp' => 0, 'comisionado' => $_POST['nomSol'],
              'noComision' => $noItem, 'obs' => $listaSalidas[$x]->obs ]);
        }
      }
      echo $noItem;
    }

    //-- obtiene la llista de salidas
    public function getSalidas(){
      $data = Salidas_alm::where('Salidas_alm.anio', '=', $_POST['anio'])
                          ->join('Areas', 'Salidas_alm.noArea', '=', 'Areas.id')
                          ->select('Salidas_alm.id', 'Salidas_alm.fechaSalida', 'Salidas_alm.nomSol', 'Salidas_alm.fechaDev',
                                  'Salidas_alm.noArea', 'Areas.nombre as are_nombre', 'Areas.encargado as are_encargado',
                                  'Salidas_alm.destino', 'Salidas_alm.obs', 'Salidas_alm.status', 'Salidas_alm.anio')->get();
      for($x=0; $x<count($data); $x++){
        $data[$x]['listSalida'] = ListaSalidas_alm::where('ListaSalidas_alm.noSalida', '=', $data[$x]['id'])
                                                              ->join('Productos_alm', 'ListaSalidas_alm.producto', '=', 'Productos_alm.id')
                                                              ->join('Categorias_alm', 'ListaSalidas_alm.categoria', '=', 'Categorias_alm.id')
                                                              ->join('Lineas_alm', 'ListaSalidas_alm.linea', '=', 'Lineas_alm.id')
                                                              ->select('ListaSalidas_alm.id', 'ListaSalidas_alm.noSalida', 'ListaSalidas_alm.producto',
                                                                      'Productos_alm.producto as pro_producto', 'ListaSalidas_alm.categoria',
                                                                      'Categorias_alm.categoria as cat_categoria', 'Categorias_alm.tipo as cat_tipo',
                                                                      'Categorias_alm.uMedida as cat_uMedida', 'ListaSalidas_alm.linea',
                                                                      'Lineas_alm.linea as lin_linea', 'ListaSalidas_alm.cantidad', 'ListaSalidas_alm.noControl',
                                                                      'ListaSalidas_alm.noSerie', 'ListaSalidas_alm.marca', 'ListaSalidas_alm.modelo',
                                                                      'ListaSalidas_alm.obs', 'ListaSalidas_alm.ubicacion', 'ListaSalidas_alm.status',
                                                                      'ListaSalidas_alm.anio'
                                                                      )->get();
          //recorreos la lista de productos en busca de los cantidades reingresadas para cada producto
          for($y=0; $y<count($data[$x]['listSalida']); $y++){
            $query = Reingresos_alm::where('noSalida', '=', $data[$x]['id'])
                                    ->where('producto', '=', $data[$x]['listSalida'][$y]['producto'])
                                    ->where('noControl', '=', $data[$x]['listSalida'][$y]['noControl'])
                                    ->select('cantidad', 'fechaReingreso')->get();
            $cantidadReingresada = 0;
            $lastDate = '';
            foreach ($query as $q) {
              $cantidadReingresada += $q['cantidad'];
              if($lastDate == ''){
                $lastDate = strtotime( $q['fechaReingreso'] );
              } else {
                  if( $lastDate < strtotime($q['fechaReingreso']) ){
                    $lastDate = strtotime( $q['fechaReingreso'] );
                  }
              }
            }
            $data[$x]['listSalida'][$y]['reingresado'] = $cantidadReingresada;
            if($lastDate != ''){
                $data[$x]['listSalida'][$y]['lastReingreso'] = date('Y-m-d', $lastDate);
            } else {
                $data[$x]['listSalida'][$y]['lastReingreso'] = $lastDate;
            }
          }
      }
      print_r( json_encode($data) );
    }

    //-- obtiene los datos de una Salida en Especifico
    public function getSalidaEsp(){
      $salida = Salidas_alm::where('id', '=', $_POST['id'])->first();
      $listaSalida = ListaSalidas_alm::join('productos_alm', 'listaSalidas_alm.producto', '=', 'productos_alm.id')
      ->join('Categorias_alm', 'Productos_alm.categoria', '=', 'Categorias_alm.id')
      ->select('listaSalidas_alm.id', 'productos_alm.producto', 'listaSalidas_alm.cantidad',
        'listaSalidas_alm.noControl', 'categorias_alm.uMedida')
      ->where('noSalida', '=',$_POST['id'])->orderBy('id')->get();
      $salida['listaSalida'] = $listaSalida;

      $area = Areas::where('id', '=', $salida['noArea'])->first();
      $salida['datosArea'] = $area;
      print_r( json_encode($salida) );
    }

    //-- Elimina una salida de la lista de productos
    public function delSalida(){
      //busca la lista de la salida
      $listaSalidas = listaSalidas_alm::where('noSalida', '=', $_POST['id'])->get();
      foreach ($listaSalidas as $itLisSalida) { // por cada elemento de la lista
        $stock = Stock_alm::join('Categorias_alm', 'Categorias_alm.id', '=', 'Stock_alm.categoria')
        ->select('Stock_alm.id', 'Stock_alm.producto', 'Stock_alm.linea', 'Stock_alm.categoria',
                'Categorias_alm.tipo', 'Stock_alm.stock', 'Stock_alm.disponible', 'Stock_alm.noDisponible',
                'Stock_alm.sub', 'Stock_alm.activo', 'Stock_alm.anio')
        ->where('Stock_alm.producto', '=', $itLisSalida['producto'])->first(); //obten los datos del Stock
        if( $stock['tipo'] == 'BII' ){ //si el producto tiene varios noControl
          $subStock = SubStock_alm::where('producto', '=', $itLisSalida['producto'])
            ->where('noControl', '=', $itLisSalida['noControl'])
            //->where('anio', '=', $_POST['anio'])
            ->first();  //obten los datos del subStock
          //suma subStock
          $data = SubStock_alm::where('producto', '=', $itLisSalida['producto'])
            ->where('noControl', '=', $itLisSalida['noControl'])
            //->where('anio', '=', $_POST['anio'])
            ->update([
              'disp' => 1, 'comisionado' => null, 'noComision' => null
            ]);
          //actualiza Stock restando noDisponibles
          $data = Stock_alm::where('producto', '=', $itLisSalida['producto'])->update([
            'disponible' => ($stock['disponible'] + $itLisSalida['cantidad']),
            'noDisponible' => ($stock['noDisponible'] - $itLisSalida['cantidad'])
          ]);
        } else if( $stock['tipo'] == 'CON') { //si el producto no tiene subStock
          $data = Stock_alm::where('producto', '=', $itLisSalida['producto'])->update([
            'stock' => ($stock['stock'] + $itLisSalida['cantidad']),
            'disponible' => ($stock['disponible'] + $itLisSalida['cantidad']),
          ]);
        } else if( $stock['tipo'] == 'BIN') { //si el producto no tiene subStock
          $data = Stock_alm::where('producto', '=', $itLisSalida['producto'])->update([
            'disponible' => ($stock['disponible'] + $itLisSalida['cantidad']),
            'noDisponible' => ($stock['noDisponible'] - $itLisSalida['cantidad'])
          ]);
        }

        //elimina elemento de la listaEntrada
        ListaSalidas_alm::where('id', '=', $itLisSalida['id'])->delete();
      }
      //Elimina entrada
      Salidas_alm::where('id', '=', $_POST['id'])->delete();
      echo 'ok';
    }

    //- Modifica la salida enviada
    public function ediSalida(){
      //eliminamos los datos de la lista Salida y recalculamos el stock
      //busca la lista de la salida
      $listaSalidasViejas = listaSalidas_alm::where('noSalida', '=', $_POST['id'])->get();
      foreach ($listaSalidasViejas as $itLisSalida) { // por cada elemento de la lista
        $stock = Stock_alm::join('Categorias_alm', 'Categorias_alm.id', '=', 'Stock_alm.categoria')
        ->select('Stock_alm.id', 'Stock_alm.producto', 'Stock_alm.linea', 'Stock_alm.categoria',
                'Categorias_alm.tipo', 'Stock_alm.stock', 'Stock_alm.disponible', 'Stock_alm.noDisponible',
                'Stock_alm.sub', 'Stock_alm.activo', 'Stock_alm.anio')
        ->where('Stock_alm.producto', '=', $itLisSalida['producto'])->first(); //obten los datos del Stock
        if( $stock['tipo'] == 'BII' ){ //si el producto tiene varios noControl
          $subStock = SubStock_alm::where('producto', '=', $itLisSalida['producto'])
            ->where('noControl', '=', $itLisSalida['noControl'])
            //->where('anio', '=', $_POST['anio'])
            ->first();  //obten los datos del subStock
          //suma subStock
          $data = SubStock_alm::where('producto', '=', $itLisSalida['producto'])
            ->where('noControl', '=', $itLisSalida['noControl'])
            //->where('anio', '=', $_POST['anio'])
            ->update([
              'disp' => 1, 'comisionado' => null, 'noComision' => null
            ]);
          //actualiza Stock restando noDisponibles
          $data = Stock_alm::where('producto', '=', $itLisSalida['producto'])->update([
            'disponible' => ($stock['disponible'] + $itLisSalida['cantidad']),
            'noDisponible' => ($stock['noDisponible'] - $itLisSalida['cantidad'])
          ]);
        } else if( $stock['tipo'] == 'CON') { //si el producto no tiene subStock
          $data = Stock_alm::where('producto', '=', $itLisSalida['producto'])->update([
            'stock' => ($stock['stock'] + $itLisSalida['cantidad']),
            'disponible' => ($stock['disponible'] + $itLisSalida['cantidad']),
          ]);
        } else if( $stock['tipo'] == 'BIN') { //si el producto no tiene subStock
          $data = Stock_alm::where('producto', '=', $itLisSalida['producto'])->update([
            'disponible' => ($stock['disponible'] + $itLisSalida['cantidad']),
            'noDisponible' => ($stock['noDisponible'] - $itLisSalida['cantidad'])
          ]);
        }
        //elimina elemento de la listaEntrada
        ListaSalidas_alm::where('id', '=', $itLisSalida['id'])->delete();
      }
       //--FIN DE ELIMINAR SALIDA

      //agregamos los nuevos productos y reaclculamos stock
      $listaSalidas = json_decode($_POST['listaSalidas']);  //obtenems la lista de productos que salen

      for($x=0; $x<count($listaSalidas); $x++){
        //guarda listaSalidas
        $data = ListaSalidas_alm::insertGetId(
          ['noSalida' => $_POST['id'], 'producto' => $listaSalidas[$x]->producto,
          'categoria' => $listaSalidas[$x]->categoria, 'linea' => $listaSalidas[$x]->linea,
          'cantidad' => $listaSalidas[$x]->cantidad, 'noControl' => $listaSalidas[$x]->noControl,
          'noSerie' => $listaSalidas[$x]->noSerie, 'marca' => $listaSalidas[$x]->marca,
          'modelo' => $listaSalidas[$x]->modelo, 'obs' => $listaSalidas[$x]->obs,
          'ubicacion' => $listaSalidas[$x]->ubicacion, 'anio' => $_POST['anio']]
        );

        // UPDATES AL ALMACEN
        if( $listaSalidas[$x]->tipo == 'CON'){
          //update STOCK
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->select('stock', 'disponible', 'noDisponible')->first(); //obtenemos stock actual
          $stock = $data['stock'];  $disponible = $data['disponible'];    $noDisponible = $data['noDisponible'];
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->update([
            'stock' => ( $stock - $listaSalidas[$x]->cantidad ),
            'disponible' => ( $disponible - $listaSalidas[$x]->cantidad )
          ]);
        } else if( $listaSalidas[$x]->tipo == 'BIN' ){
          //update STOCK
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->select('stock', 'disponible', 'noDisponible')->first(); //obtenemos stock actual
          $stock = $data['stock'];  $disponible = $data['disponible'];    $noDisponible = $data['noDisponible'];
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->update([
            'disponible' => ( $disponible - $listaSalidas[$x]->cantidad ),
            'noDisponible' => ( $noDisponible + $listaSalidas[$x]->cantidad )
          ]);
        } else if( $listaSalidas[$x]->tipo == 'BII' ) {
          //update STOCK
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->select('stock', 'disponible', 'noDisponible')->first(); //obtenemos stock actual
          $stock = $data['stock'];  $disponible = $data['disponible'];    $noDisponible = $data['noDisponible'];
          $data = Stock_alm::where( 'producto', '=', $listaSalidas[$x]->producto )->update([
            'disponible' => ( $disponible - $listaSalidas[$x]->cantidad ),
            'noDisponible' => ( $noDisponible + $listaSalidas[$x]->cantidad )
          ]);

          //update subSTOCK si tipo = BIEN INVENTARIABLE
          $data = SubStock_alm::where('producto', '=', $listaSalidas[$x]->producto)
            ->where('noControl', '=', $listaSalidas[$x]->noControl)
            //->where('anio', '=', $_POST['anio'])
            ->update([ 'disp' => 0, 'comisionado' => $_POST['nomSol'],
              'noComision' => $_POST['id'], 'obs' => $listaSalidas[$x]->obs ]);
        }
      }

      //actualizamos los datos antiguos de la salida con los nuevos enviados en s_POST
      $data = Salidas_alm::where('id', '=', $_POST['id'])
        ->update([ 'fechaSalida' => $_POST['fechaSalida'], 'noArea' => $_POST['noArea'],
          'nomSol' => $_POST['nomSol'], 'destino' => $_POST['destino'],
          'fechaDev' => $_POST['fechaDev'], 'obs' => $_POST['obs'] ]);

      echo 'ok';
    }

  //-------------------------------------------------
  //-- ListaSalidas
    //-- Obtiene el listado de productos para una Salida
    public function getSalProductos(){
      $listaSalidas = ListaSalidas_alm::where('listaSalidas_alm.noSalida', '=', $_POST['id'])
        ->join('Productos_alm', 'Productos_alm.id', '=', 'ListaSalidas_alm.producto')
        ->join('Categorias_alm', 'Categorias_alm.id', '=', 'Productos_alm.categoria')
        ->select('ListaSalidas_alm.id as id', 'ListaSalidas_alm.noSalida as noSalida',
          'Productos_alm.producto as nomProducto', 'ListaSalidas_alm.cantidad as cantidad',
          'ListaSalidas_alm.noControl as noControl', 'Categorias_alm.uMedida', 'ListaSalidas_alm.status as status')
        ->get();
      print_r(json_encode($listaSalidas));
    }

  //-------------------------------------------------
  //-- Reingresos
    //-- reingresa stock bienes y consumibles (actualiza datos de salida en caso de bienes)
    public function addReingreso(){
      //dependiendo del tipo de producto que estoy trabajando realizo distintas acciones
      //obtengo stock actual
      $stock = Stock_alm::where('producto', '=', $_POST['producto'])->first();

      switch ( $_POST['tipo'] ) {
        case 'CON':         //si es cons8umible
            //actualizamos stock sumando la cantidad
            $data = Stock_alm::where('producto', '=', $_POST['producto'])
              ->update([ 'stock' => ($stock['stock'] + $_POST['cantidad']),
                      'disponible' => ($stock['disponible'] + $_POST['cantidad']) ]);
        break;

        case 'BIN':         //si es bien no inventariables
            //actualizamos stock sumando la cantidad
            $data = Stock_alm::where('producto', '=', $_POST['producto'])
              ->update([ 'noDisponible' => ($stock['noDisponible'] - $_POST['cantidad']),
                      'disponible' => ($stock['disponible'] + $_POST['cantidad']) ]);

            //obtengo datos del objeto que esoty afectando en la salida
            $objSalida = ListaSalidas_alm::where('noSalida', '=', $_POST['noSalida'])->where('producto', '=', $_POST['producto'])->first();

            //obtenemos los reingresos de esta salida y producto y contamos cuantos se han reingresado ya
            $proRein = Reingresos_alm::where('noSalida', '=', $_POST['noSalida'])->where('producto', '=', $_POST['producto'])->get();
            $cantidadReingresada = $_POST['cantidad'];    //partimos de la cantidad obtenida del formulario
            for($x=0; $x<count($proRein); $x++){
              $cantidadReingresada += $proRein['cantidad'];     //sumamos todas las cantidades anteriormente reingresadas
            }

            if($cantidadReingresada >= $objSalida['cantidad'] ){   //si la cantidad total a reingresa es >= que la de la salida
              $data = ListaSalidas_alm::where('noSalida', '=', $_POST['noSalida'])->where('producto', '=', $_POST['producto'])
              ->update([ "status" => 0 ]);
            }
        break;

        case 'BII':         //si es bien inventariable
          //actualizamos stock sumando la cantidad
          $data = Stock_alm::where('producto', '=', $_POST['producto'])
            ->update([ 'noDisponible' => ($stock['noDisponible'] - $_POST['cantidad']),
                    'disponible' => ($stock['disponible'] + $_POST['cantidad']) ]);
          //actualizo el subSTOCK
          $data = SubStock_alm::where('producto', '=', $_POST['producto'])->where('noControl', '=', $_POST['noControl'])
            ->update([ 'disp' => 1, 'comisionado' => null, 'noComision' => null ]);

          $data = ListaSalidas_alm::where('noSalida', '=', $_POST['noSalida'])
            ->where('producto', '=', $_POST['producto'])
            ->where('noControl', '=', $_POST['noControl'])
            ->update([ "status" => 0 ]);
        break;
      } //termina switch

      //revisamos el status de la lista de productos de la salida
      $allValidated = 0;        //0 - todos validados,    1 - aun sin validar
      $listaSalida = ListaSalidas_alm::where('noSalida', '=', $_POST['noSalida'])->get();
      for($x=0; $x<count($listaSalida); $x++){
        if($listaSalida[$x]['status'] == 1){
            $allValidated = 1;
        }
      }
      //si todos estan validados entonces cambiamos el status de la salida a validada
      if($allValidated == 0){
        $data = Salidas_alm::where('id', '=', $_POST['noSalida'])->update([ 'status' => 1 ]);
      }

      //testeamos las fechas
      $fechaLim = new \DateTime( $_POST['fechaLim'] );
      $fechaDev = new \DateTime( $_POST['fechaDev'] );
      if($fechaLim > $fechaDev){
        $statusDev =  1;
      } else {
        $statusDev = 0;
      }

      //almacenamos datos del reingreso en la DB
      $data = Reingresos_alm::insertGetId([
        'noSalida' => $_POST['noSalida'], 'nombre' => $_POST['nombre'], 'area' => $_POST['noArea'],
        'producto' => $_POST['producto'], 'tipo' => $_POST['tipo'], 'noControl' => $_POST['noControl'],
        'cantidad' => $_POST['cantidad'], 'fechaReingreso' => $_POST['fechaDev'], 'statusDev' => $statusDev,
        'anio' => $_POST['anio']
      ]);


      //OBTENGO LOS DATOS D LA SALIDA MODIFICADA PARA PINTARLO NUEVAMENTE
      $data = Salidas_alm::where('Salidas_alm.id', '=', $_POST['noSalida'])
                          ->join('Areas', 'Salidas_alm.noArea', '=', 'Areas.id')
                          ->select('Salidas_alm.id', 'Salidas_alm.fechaSalida', 'Salidas_alm.nomSol', 'Salidas_alm.fechaDev',
                                  'Salidas_alm.noArea', 'Areas.nombre as are_nombre', 'Areas.encargado as are_encargado',
                                  'Salidas_alm.destino', 'Salidas_alm.obs', 'Salidas_alm.status', 'Salidas_alm.anio')->first();

      $data['listSalida'] = ListaSalidas_alm::where('ListaSalidas_alm.noSalida', '=', $data['id'])
                                              ->join('Productos_alm', 'ListaSalidas_alm.producto', '=', 'Productos_alm.id')
                                              ->join('Categorias_alm', 'ListaSalidas_alm.categoria', '=', 'Categorias_alm.id')
                                              ->join('Lineas_alm', 'ListaSalidas_alm.linea', '=', 'Lineas_alm.id')
                                              ->select('ListaSalidas_alm.id', 'ListaSalidas_alm.noSalida', 'ListaSalidas_alm.producto',
                                                      'Productos_alm.producto as pro_producto', 'ListaSalidas_alm.categoria',
                                                      'Categorias_alm.categoria as cat_categoria', 'Categorias_alm.tipo as cat_tipo',
                                                      'Categorias_alm.uMedida as cat_uMedida', 'ListaSalidas_alm.linea',
                                                      'Lineas_alm.linea as lin_linea', 'ListaSalidas_alm.cantidad', 'ListaSalidas_alm.noControl',
                                                      'ListaSalidas_alm.noSerie', 'ListaSalidas_alm.marca', 'ListaSalidas_alm.modelo',
                                                      'ListaSalidas_alm.obs', 'ListaSalidas_alm.ubicacion', 'ListaSalidas_alm.status',
                                                      'ListaSalidas_alm.anio')->get();

          //recorreos la lista de productos en busca de los cantidades reingresadas para cada producto
          for($y=0; $y<count($data['listSalida']); $y++){
            $query = Reingresos_alm::where('noSalida', '=', $data['id'])
                                    ->where('producto', '=', $data['listSalida'][$y]['producto'])
                                    ->where('noControl', '=', $data['listSalida'][$y]['noControl'])
                                    ->select('cantidad')->get();
            $cantidadReingresada = 0;
            foreach ($query as $q) {
              $cantidadReingresada += $q['cantidad'];
            }
            $data['listSalida'][$y]['reingresado'] = $cantidadReingresada;
          }

      print_r( json_encode($data) );


    }


  //-------------------------------------------------
  //-- Áreas
    //-- Obtiene la lista de areas
    public function getListaAreas(){
      $areas['direcciones'] = Areas::where('nivel', '<=', 2)->orderBy('id')->get();
      for($x=0; $x<count($areas['direcciones']); $x++){
        if($areas['direcciones'][$x]['nivel'] != 1){
          $areas['direcciones'][$x]['sub'] = Areas::where('adscripcion', '=', $areas['direcciones'][$x]['id'])->orderby('id')->get();
        } else { $areas['direcciones'][$x]['sub'] = []; }
      }

      print_r(json_encode($areas));
    }

  //-------------------------------------------------
  //-- test
    public function test(){
      echo 'holi';
    }
}
