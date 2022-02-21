<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Usuarios;
use App\Modelos\Bitacora;
use App\Modelos\Aniosactivos;
use Session;


class mainController extends Controller
{
    //obtengo los años activos
    public $aniosA;

    //el constructor recopila la informacion de las variables de este objeto
    public function __construct()
    {
      $this->aniosA = Aniosactivos::where('activo', '=', 1)->select('anio')->get();
    }

    //--  muestra el index
    public function index()
    {
        if( session('usuario') == Null ){
          return view('main.pages.login');
        } else {
          //-- temporalmente redirecciona a almacen
          return view('main.pages.index')->with('aniosA', $this->aniosA);;
          //return redirect('/almacen');
        }
    }

    //--  carga login y datos de sesión
    public function loadLogin()
    {
      $usuario = Usuarios::where('usuario', '=', $_POST['usuario'])
                            ->where('activo', '=', 1)->first();
      if($usuario != ""){
        if( $usuario['pass'] == $_POST['contraseña'] ){
          Session::put([ 'usuario' => $usuario['usuario'] ]);
          Session::put([ 'anio' => $_POST['anio'] ]);
          Session::put([ 'nombre' => $usuario['nombre'] ]);
          Session::put([ 'apellido' => $usuario['apellido'] ]);
          Session::put([ 'mail' => $usuario['mail'] ]);
          Session::put([ 'sicofi' => $usuario['sicofi'] ]);
          Session::put([ 'nomina' => $usuario['nomina'] ]);
          Session::put([ 'almacen' => $usuario['almacen'] ]);
          Session::put([ 'asistencias' => $usuario['asistencias'] ]);

          //creamos la entrada en la bitacora
          $data = Bitacora::insertGetId(
              ['usuario' => $usuario['usuario'], 'fecha' => date('Y-m-d H:i:s')]
          );

          return redirect('/');
        } else {
          return  Redirect::back()->withErrors('La contraseña es incorrecta');
        }
      } else {
        return  Redirect::back()->withErrors('El usuario no esta registrado');
      }
    }

    //--  Destruye variables de Sesion
    public function logOff()
    {
      session()->flush();
      return redirect('/');
    }

    //-- cambia el año con el que se esta trabajando
    public function cambiaAnio($origen, $anio)
    {
        Session::put([ 'anio' => $anio ]);
        return redirect('/'.$origen);
    }
}
