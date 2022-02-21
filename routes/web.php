<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('login');
});*/

//--------------------------------------------------------
//                     RUTAS DEL MAIN
  Route::get('/', 'Main\mainController@index')->name('main.index');
  Route::post('/loadLogin', 'Main\mainController@loadLogin')->name('main.loadLogin');

  //-- LOGIN MODDLEWARE
  Route::group(['middleware' => 'login'], function () {
    //-------------------------------------------------

      Route::get('/logOff', 'Main\mainController@logOff')->name('main.logOff');
      Route::get('/cambiaAnio/{origen}/{id}', 'Main\mainController@cambiaAnio')->name('main.cambiaAnio');

    //--------------------------------------------------------
    //                     RUTAS DE ALMACEN
      Route::get('/almacen', 'Almacen\almacenController@index')->name('almacen.index');
      Route::get('/almacen/catalogo', 'Almacen\almacenController@catalogo')->name('almacen.catalogo')->middleware('alm_adm_middleware');
      Route::get('/almacen/entradas', 'Almacen\almacenController@entradas')->name('almacen.entradas');
      Route::get('/almacen/salidas', 'Almacen\almacenController@salidas')->name('almacen.salidas');
      Route::get('/almacen/salImp/{id}', 'Almacen\almacenController@salImp')->name('almacen.salidas.salImp');
      Route::get('/almacen/reingresos', 'Almacen\almacenController@reingresos')->name('almacen.reingresos');
      Route::get('/almacen/reportes/existencias', 'Almacen\almacenController@existencias')->name('almacen.reportes.existencias');
      Route::get('/almacen/reportes/repSalidas', 'Almacen\almacenController@repSalidas')->name('almacen.reportes.repSalidas');

      Route::get('/test', 'Almacen\almacenController@test')->name('test');

    //-------------------------------------------------
  });
