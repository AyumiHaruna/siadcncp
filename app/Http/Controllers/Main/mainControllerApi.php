<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Modelos\Aniosactivos;


class mainControllerApi extends Controller
{
    //--   obtiene los años activos en el sistema
    public function aniosActivos()
    {
      $anios = Aniosactivos::all()->where('activo', '=', 1);
      //$anios = aniosActivos::all();
      foreach( $anios as $anio ){
        $data[] = $anio;
      }
        print_r(json_encode($data));
    }


}
