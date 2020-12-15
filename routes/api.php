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

Route::post('/Login/Salir', ['middleware' => 'cors', 'uses' => 'LoginController@salir']);
Route::post('/Login/GetUsers', ['middleware' => 'cors', 'uses' => 'LoginController@getUsuarios']);
Route::post('/Login/getpr', ['middleware' => 'cors', 'uses' => 'LoginController@adminPr']);
Route::post('/auth/login','LoginController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/Bodega/GetUbicaciones', ['middleware' => 'cors', 'uses' => 'MaterialUbicacionesController@getAll']);
    Route::get('/Bodega/GetServicios', ['middleware' => 'cors', 'uses' => 'MaterialServiciosController@getAll']);
    Route::get('/Bodega/GetMedidas', ['middleware' => 'cors', 'uses' => 'MaterialMedidasController@getAll']);
    Route::get('/Bodega/GetMaterial', ['middleware' => 'cors', 'uses' => 'MaterialIngresadoController@getAll']);
    Route::get('/Bodega/GetTipoMaterial', ['middleware' => 'cors', 'uses' => 'MaterialTipoController@getAll']);
    Route::get('/Bodega/GetCantEsp', ['middleware' => 'cors', 'uses' => 'MaterialCantidadesEspecificasController@getAll']);
    Route::post('/Bodega/PostMaterial', ['middleware' => 'cors', 'uses' => 'MaterialIngresadoController@PostMaterial']);
    Route::post('/Bodega/PostTipoMaterial', ['middleware' => 'cors', 'uses' => 'MaterialTipoController@PostTipoMaterial']);
    Route::post('/Bodega/PostCantEsp', ['middleware' => 'cors', 'uses' => 'MaterialCantidadesEspecificasController@PostCantEsp']);
});
