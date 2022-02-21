<?php

namespace App\Http\Controllers\Sicofi;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Sicofi\SicProyectos;
use Session;

class sicofiControllerApi extends Controller
{
  //     CREADAS DE ACORDE A LA TABLA QUE AFECTAN
  //-------------------------------------------------
  //-- Proyectos
    //-- Obtiene la lista de proyectos activos
    public function getListaProyectos(){
      $proyectos = SicProyectos::on('mysqlSicofi'.$_POST['anio'])->get();
      print_r( json_encode($proyectos) );
    }

    //-- Obtiene un proyecto especificos
    /*public function getListaProyectos(){
      $proyectos = SicProyectos::on('mysqlSicofi'.$_POST['anio'])->where('noProy', '=', $_POST['noProy'])->first();
      print_r( json_encode($proyectos) );
    }*/

  //-- test
    public function test(){
      echo 'holi';
    }
}
