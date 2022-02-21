<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return 'api user';
    return $request->user();
});*/

//--------------------------------------------------------
//                     RUTAS DEL MAIN API
Route::post('/aniosActivos', 'Main\mainControllerApi@aniosActivos')->name('main.api.aniosActivos');



//--------------------------------------------------------
//                     RUTAS DE ALMACEN API
//-- almacen -> Catalogo
Route::post('almacen/catalogo/getLineas', 'Almacen\almacenControllerApi@getLineas')->name('almacen.api.cataologo.getLineas');
Route::post('almacen/catalogo/addLinea', 'Almacen\almacenControllerApi@addLinea')->name('almacen.api.catalogo.addLinea');
Route::post('almacen/catalogo/inhabilitaLinea', 'Almacen\almacenControllerApi@inhabilitaLinea')->name('almacen.api.cataologo.inhabilitaLinea');
Route::post('almacen/catalogo/habilitaLinea', 'Almacen\almacenControllerApi@habilitaLinea')->name('almacen.api.cataologo.habilitaLinea');
Route::post('almacen/catalogo/ediLinea', 'Almacen\almacenControllerApi@ediLinea')->name('almacen.api.cataologo.ediLinea');
Route::post('almacen/catalogo/addCategoria', 'Almacen\almacenControllerApi@addCategoria')->name('almacen.api.cataologo.addCategoria');
Route::post('almacen/catalogo/getCategorias', 'Almacen\almacenControllerApi@getCategorias')->name('almacen.api.cataologo.getCategorias');
Route::post('almacen/catalogo/inhabilitaCategoria', 'Almacen\almacenControllerApi@inhabilitaCategoria')->name('almacen.api.cataologo.inhabilitaCategoria');
Route::post('almacen/catalogo/habilitaCategoria', 'Almacen\almacenControllerApi@habilitaCategoria')->name('almacen.api.cataologo.habilitaCategoria');
Route::post('almacen/catalogo/getCategoriaEspecifica', 'Almacen\almacenControllerApi@getCategoriaEspecifica')->name('almacen.api.cataologo.getCategoriaEspecifica');
Route::post('almacen/catalogo/ediCategoria', 'Almacen\almacenControllerApi@ediCategoria')->name('almacen.api.cataologo.ediCategoria');
Route::post('almacen/catalogo/getCategoriasXLinea', 'Almacen\almacenControllerApi@getCategoriasXLinea')->name('almacen.api.cataologo.getCategoriasXLinea');
Route::post('almacen/catalogo/addProducto', 'Almacen\almacenControllerApi@addProducto')->name('almacen.api.cataologo.addProducto');
Route::post('almacen/catalogo/getProductos', 'Almacen\almacenControllerApi@getProductos')->name('almacen.api.cataologo.getProductos');
Route::post('almacen/catalogo/inhabilitaProducto', 'Almacen\almacenControllerApi@inhabilitaProducto')->name('almacen.api.cataologo.inhabilitaProducto');
Route::post('almacen/catalogo/habilitaProducto', 'Almacen\almacenControllerApi@habilitaProducto')->name('almacen.api.cataologo.habilitaProducto');
Route::post('almacen/catalogo/getProductoEspecifico', 'Almacen\almacenControllerApi@getProductoEspecifico')->name('almacen.api.cataologo.getProductoEspecifico');
Route::post('almacen/catalogo/ediProducto', 'Almacen\almacenControllerApi@ediProducto')->name('almacen.api.cataologo.ediProducto');
//-- almacen -> entradas
Route::post('almacen/entradas/getLineas', 'Almacen\almacenControllerApi@getLineas')->name('almacen.api.entradas.getLineas');
Route::post('almacen/entradas/getCategorias', 'Almacen\almacenControllerApi@getCategorias')->name('almacen.api.entradas.getCategorias');
Route::post('almacen/entradas/getProductos', 'Almacen\almacenControllerApi@getProductos')->name('almacen.api.entradas.getProductos');
Route::post('almacen/entradas/getCategoriaEspecifica', 'Almacen\almacenControllerApi@getCategoriaEspecifica')->name('almacen.api.entradas.getCategoriaEspecifica');
Route::post('almacen/entradas/addEntrada', 'Almacen\almacenControllerApi@addEntrada')->name('almacen.api.entradas.addEntrada');
Route::post('almacen/entradas/getEntradas', 'Almacen\almacenControllerApi@getEntradas')->name('almacen.api.entradas.getEntradas');
Route::post('almacen/entradas/getEntProductos', 'Almacen\almacenControllerApi@getEntProductos')->name('almacen.api.entradas.getEntProductos');
Route::post('almacen/entradas/delEntrada', 'Almacen\almacenControllerApi@delEntrada')->name('almacen.api.entradas.delEntrada');
Route::post('almacen/entradas/canProdBeAdd', 'Almacen\almacenControllerApi@canProdBeAdd')->name('almacen.api.entradas.canProdBeAdd');
Route::post('almacen/entradas/ediEntrada', 'Almacen\almacenControllerApi@ediEntrada')->name('almacen.api.entradas.ediEntrada');
//-- almacen -> salidas
Route::post('almacen/salidas/getStockLineas', 'Almacen\almacenControllerApi@getStockLineas')->name('almacen.api.salidas.getStockLineas');
Route::post('almacen/salidas/getStockCategorias', 'Almacen\almacenControllerApi@getStockCategorias')->name('almacen.api.salidas.getStockCategorias');
Route::post('almacen/salidas/getStockProductos', 'Almacen\almacenControllerApi@getStockProductos')->name('almacen.api.salidas.getStockProductos');
Route::post('almacen/salidas/getCategoriaEspecifica', 'Almacen\almacenControllerApi@getCategoriaEspecifica')->name('almacen.api.salidas.getCategoriaEspecifica');
Route::post('almacen/salidas/testProdStock', 'Almacen\almacenControllerApi@testProdStock')->name('almacen.api.salidas.testProdStock');
Route::post('almacen/salidas/addSalida', 'Almacen\almacenControllerApi@addSalida')->name('almacen.api.salidas.addSalida');
Route::post('almacen/salidas/getSalidas', 'Almacen\almacenControllerApi@getSalidas')->name('almacen.api.salidas.getSalidas');
Route::post('almacen/salidas/getSalProductos', 'Almacen\almacenControllerApi@getSalProductos')->name('almacen.api.salidas.getSalProductos');
Route::post('almacen/salidas/delSalida', 'Almacen\almacenControllerApi@delSalida')->name('almacen.api.salidas.delSalida');
Route::post('almacen/salidas/getListaProyectos', 'sicofi\sicofiControllerApi@getListaProyectos')->name('sicofi.api.salidas.getListaProyectos');
Route::post('almacen/salidas/getListaAreas', 'Almacen\almacenControllerApi@getListaAreas')->name('almacen.api.salidas.getListaAreas');
Route::post('almacen/salidas/ediSalida', 'Almacen\almacenControllerApi@ediSalida')->name('almacen.api.salidas.ediSalida');
//-- almacen -> formatos
Route::post('almacen/formatos/getSalidaEsp', 'Almacen\almacenControllerApi@getSalidaEsp')->name('almacen.api.formatos.getSalida');
Route::post('almacen/formatos/getProyectoEspecifico', 'sicofi\sicofiControllerApi@getProyectoEspecifico')->name('sicofi.api.formatos.getProyectoEspecifico');
//-- almacen -> reingresos
Route::post('almacen/reingresos/getSalidas', 'Almacen\almacenControllerApi@getSalidas')->name('almacen.api.reingresos.getSalidas');
Route::post('almacen/reingresos/addReingreso', 'Almacen\almacenControllerApi@addReingreso')->name('almacen.api.reingresos.addReingreso');
//-- almacen -> reportes
Route::post('almacen/reportes/existencias/getFullStock', 'Almacen\almacenControllerApi@getFullStock')->name('almacen.api.reportes.existencias.getFullStock');
Route::post('almacen/reportes/existencias/getLineas', 'Almacen\almacenControllerApi@getLineas')->name('almacen.api.reportes.existencias.getLineas');
Route::post('almacen/reportes/existencias/getCategorias', 'Almacen\almacenControllerApi@getCategorias')->name('almacen.api.reportes.existencias.getCategorias');
Route::post('/almacen/reportes/repSalidas/getSalidas', 'Almacen\almacenControllerApi@getSalidas')->name('almacen.api.reportes.repSalidas.getSalidas');
