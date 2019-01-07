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


Route::get('/', function () {

	
	 return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', array(
		'as' => 'home',
		'uses' => 'ContractController@index'
		
));


// Rutas del controlador de Contract
Route::get('/list-contract', array(
		'as' => 'listContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@index'	
));

Route::get('/create-contract', array(
		'as' => 'createContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@createContract'	
));

Route::post('/save-contract', array(
		'as' => 'saveContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@saveContract'	
));

// Rutas edicion contract  
Route::get('/{id}/edit-contract', array(
		'as' => 'editContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@editContract'	
));

Route::post('/{id}/update-contract', array(
		'as' => 'updateContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@updateContract'	
));

/*Route::post('/{id}/delete', array(
		'as' => 'destroyContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@destroyContract'	
));*/
Route::delete('/{id}', array(
		'as' => 'destroyContract',
		'middleware' => 'auth',	
		'uses' => 'ContractController@destroyContract'	
));

// Services

// Rutas del controlador de services
Route::get('/list-service', array(
		'as' => 'listService',
		'middleware' => 'auth',	
		'uses' => 'ServiceController@index'	
));

Route::get('/create-service', array(
		'as' => 'createService',
		'middleware' => 'auth',	
		'uses' => 'ServiceController@createService'	
));

Route::post('/save-service', array(
		'as' => 'saveService',
		'middleware' => 'auth',	
		'uses' => 'ServiceController@saveService'	
));

// Rutas edicion services  
Route::get('/{id}/edit-service', array(
		'as' => 'editService',
		'middleware' => 'auth',	
		'uses' => 'ServiceController@editService'	
));

Route::post('/{id}/update-service', array(
		'as' => 'updateService',
		'middleware' => 'auth',	
		'uses' => 'ServiceController@updateService'	
));

Route::delete('/{id}/destroy', array(
		'as' => 'destroyService',
		'middleware' => 'auth',	
		'uses' => 'ServiceController@destroyService'	
));

// Rutas Entiad
Route::get('/list-entity', array(
		'as' => 'listEntity',
		'middleware' => 'auth',	
		'uses' => 'EntityController@index'	
));