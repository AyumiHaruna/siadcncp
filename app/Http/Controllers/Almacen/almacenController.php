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
use App\Modelos\Aniosactivos;

use App\Modelos\Sicofi\SicProyectos;
use Session;

class almacenController extends Controller
{
    //obtengo los años activos
    public $aniosA;

    //el constructor recopila la informacion de las variables de este objeto
    public function __construct()
    {
      $this->aniosA = Aniosactivos::where('activo', '=', 1)->select('anio')->get();
    }


    public function index() {
      return view('almacen.pages.index')->with('aniosA', $this->aniosA);
    }

    //-- VISTAS DE FORMULARIOS

    public function catalogo() {
      return view('almacen.pages.catalogo')->with('aniosA', $this->aniosA);
    }

    public function entradas() {
      return view('almacen.pages.entradas')->with('aniosA', $this->aniosA);
    }

    public function salidas() {
      return view('almacen.pages.salidas')->with('aniosA', $this->aniosA);
    }

    public function salImp($id) {
      //obtengo el status de la Salida
      $salStat = Salidas_alm::where('id', '=', $id)->select('status')->first();
      $salStat = $salStat['status'];

      //Obtenemos la lista de productos de la salida
      $listaSalida = ListaSalidas_alm::where('noSalida', '=', $id)
          ->join('Categorias_alm', 'Categorias_alm.id', '=', 'ListaSalidas_alm.categoria')
          ->select('ListaSalidas_alm.id', 'Categorias_alm.tipo')->get();

      //si el stat aun es 0, actualizamos los Stat de la salida como de sus productos
      if($salStat == 0){
        $flagSalida = 1;      //flag para saber si la salida requiere devolucion o no   //0 = no //1 = si
        foreach ($listaSalida as $item) {  //recorremos array
          if($item['tipo'] == 'BII' || $item['tipo'] == 'BIN'){
            $flagSalida = 2;
            $data = ListaSalidas_alm::where('id', '=', $item['id'])->update([ 'status' => 1 ]);
          }
        }

        //actualizamos el status con el flag
        $data = Salidas_alm::where('id', '=', $id)->update([ 'status' => $flagSalida ]);
      }

      //cuenta el no de paginas que tendra el documento
      $noItems = count($listaSalida);
      $noPags = intval(($noItems/10)+1);
      return view('almacen.formatos.salImp', ['noSalida' => $id, 'noPags' => $noPags]);
    }

    public function reingresos() {
      return view('almacen.pages.reingresos')->with('aniosA', $this->aniosA);
    }

    //-- VISTA DE REPORTES

    public function existencias(){
      return view('almacen.pages.reporteExistencias')->with('aniosA', $this->aniosA);
    }

    public function repSalidas(){
      return view('almacen.pages.reporteSalidas')->with('aniosA', $this->aniosA);
    }

    //-- VISTA DE PRUEBAS

    public function test(){
      //
    }
}
