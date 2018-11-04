<?php

use Illuminate\Support\Facades\DB;

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

//Api
//Cliente

Route::prefix('api')->group(function () {
 	Route::get('cliente', 'ClienteController@index');
 	Route::post('cliente', 'ClienteController@storeApi');
 	//Aeropuerto
 	Route::get('aeropuerto', 'AeropuertoController@index');
 	Route::post('aeropuerto', 'AeropuertoController@storeApi');
 	//Aviones
 	Route::get('avion','AvionController@index');
 	Route::post('avion','AvionController@storeApi');
 	//Vuelo 
 	Route::get('vuelo','VueloController@index');
 	Route::post('vuelo','VueloController@storeApi');
 	
	
});

Route::get('/','HomeController@inicio');

/*
Route::get("/", function(){
	 return redirect('cliente');
});*/


//admin
//Cliente
Route::get('cliente', 'ClienteController@home');
Route::post('cliente', 'ClienteController@store');
Route::post('cliente/delete', 'ClienteController@delete');
Route::get('cliente/edit/{id}', 'ClienteController@edit');
Route::post('cliente/update', 'ClienteController@update');



//Cliente 
Route::get('aeropuerto','AeropuertoController@home');
Route::post('aeropuerto', 'AeropuertoController@store');
Route::post('aeropuerto/delete','AeropuertoController@delete');
Route::get('aeropuerto/edit/{id}','AeropuertoController@edit');
Route::post('aeropuerto/update','AeropuertoController@update');

//Avion
Route::get('avion','AvionController@home');
Route::post('avion', 'AvionController@store');
Route::post('avion/delete','AvionController@delete');
Route::get('avion/edit/{id}','AvionController@edit');
Route::post('avion/update','AvionController@update');

//Vuelo
Route::get('vuelo','VueloController@home');
Route::post('vuelo', 'VueloController@store');
Route::post('vuelo/delete','VueloController@delete');
Route::get('vuelo/edit/{id}','VueloController@edit');
Route::post('vuelo/update','VueloController@update');


//Embarque
Route::get('embarque','EmbarqueController@home');
