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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/Login/Salir', 'LoginController@salir');
Route::post('/Login/GetUsers', 'LoginController@getUsuarios');
Route::post('/Login/getpr', 'LoginController@adminPr');
Route::post('/auth/login','LoginController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
    //Gets
    Route::get('/Bodega/GetUbicaciones', ['middleware' => 'cors', 'uses' => 'MaterialUbicacionesController@getAll']);
    Route::get('/Bodega/GetServicios', ['middleware' => 'cors', 'uses' => 'MaterialServiciosController@getAll']);
    Route::get('/Bodega/GetMedidas', ['middleware' => 'cors', 'uses' => 'MaterialMedidasController@getAll']);
    Route::get('/Bodega/GetMedidasFiltradas', ['middleware' => 'cors', 'uses' => 'MaterialMedidasController@filtroMedidas']);
    Route::get('/Bodega/GetMaterial', ['middleware' => 'cors', 'uses' => 'MaterialIngresadoController@getAll']);
    Route::get('/Bodega/GetCubiculos', ['middleware' => 'cors', 'uses' => 'MaterialCubiculosController@getAll']);
    Route::get('/Bodega/GetCantEsp', ['middleware' => 'cors', 'uses' => 'MaterialCantidadesEspecificasController@getAll']);
    Route::get('/Bodega/GetInventario', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@getAll']);
    Route::get('/Bodega/GetStock', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@getListadoStock']);
    Route::get('/Bodega/GetTotalStock', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@getStockTotal']);
    Route::get('/Bodega/GetDocumentos', ['middleware' => 'cors', 'uses' => 'DocumentosAsociadosController@getAll']);
    Route::get('/Bodega/TraerMaterial/{id}', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@TraerMaterial']);
    Route::get('/Bodega/TraerMaterialEspecifico/{id}', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@TraerMaterialEspecifico']);
    Route::get('/Bodega/GetSeguimientoMaterial/{id}', ['middleware' => 'cors', 'uses' => 'SeguimientoMaterialesController@GetSeguimientoMaterial']);
    Route::get('/Bodega/GetRMateriales', ['middleware' => 'cors', 'uses' => 'RetornarMaterialesController@ListadoRMateriales']);
    
    //Posts 
    Route::post('/Bodega/PostMaterial', ['middleware' => 'cors', 'uses' => 'MaterialIngresadoController@PostMaterial']);
    Route::post('/Bodega/PostCubiculo', ['middleware' => 'cors', 'uses' => 'MaterialCubiculosController@PostCubiculo']);
    Route::post('/Bodega/PostServicio', ['middleware' => 'cors', 'uses' => 'MaterialServiciosController@PostServicio']);
    Route::post('/Bodega/PostUbicacion', ['middleware' => 'cors', 'uses' => 'MaterialUbicacionesController@PostUbicacion']);
    Route::post('/Bodega/PostCantEsp', ['middleware' => 'cors', 'uses' => 'MaterialCantidadesEspecificasController@PostCantEsp']);
    Route::post('/Bodega/PostInventario', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@createInventario']);
    Route::post('/Bodega/PostHistorialMateriales', ['middleware' => 'cors', 'uses' => 'HistorialMaterialesController@store']);
    Route::post('/Bodega/PostRetornoMateriales', ['middleware' => 'cors', 'uses' => 'RetornarMaterialesController@store']);
    Route::post('/Bodega/PostAsignarMaterial', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@PostAsignarMaterial']);
    Route::post('/Bodega/PostSeguimientoMaterial/{idUser}', ['middleware' => 'cors', 'uses' => 'SeguimientoMaterialesController@PostSeguimientoMaterial']);
    Route::post('/Bodega/PostStockDevolucion', ['middleware' => 'cors', 'uses' => 'RetornarMaterialesController@PostStockDevolucion']);

    //Post Como Put
    Route::post('/Bodega/PutInventario', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@PutInventario']);
    Route::post('/Bodega/PutAsignarMaterial', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@PutAsignarMaterial']);
    Route::post('/Bodega/PutHistorialMateriales', ['middleware' => 'cors', 'uses' => 'HistorialMaterialesController@PutHistorialMateriales']);
    Route::post('/Bodega/PutRetornoMateriales', ['middleware' => 'cors', 'uses' => 'RetornarMaterialesController@PutRetornoMateriales']);

    
});

//Generar PDF
Route::get('/Bodega/ActaEntregaPDF/{idSolicitud}/{idCategoria}/{nombre}', ['middleware' => 'cors', 'uses' => 'MaterialInventariosController@ActaEntregaPDF']);
