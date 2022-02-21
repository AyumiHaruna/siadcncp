<?php

namespace App\Http\Controllers\Sicofi;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Sicofi\SicProyectos;
use Session;

class sicofiController extends Controller
{
  //     CREADAS DE ACORDE A LA TABLA QUE AFECTAN
  //-------------------------------------------------

  //-- test
    public function test(){      
      $proyectos = SicProyectos::on('mysqlSicofi'.Session('anio'))->get();
      print_r( json_encode($proyectos) );
    }
}
