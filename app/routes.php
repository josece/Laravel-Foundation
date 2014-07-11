<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
| 
@tittle Wedding Invite RSVP System
@author Jose Antonio Calleja Esnal
@startdate 20 June 2014



*/

/**
 * Limite de acceso en Filtros
 * niveles de acceso:
 * auth.admin - 3
 * auth.medium - 2
 * auth.basic -1
 * guest() - 0
 */

Route::group(array('before' => 'auth|auth.admin'), function() {
	Route::controller('admin','AdminController');
	/*Route::get('user/super/edit/',array('uses' => 'UsersController@getEditadmin'));
	Route::get('user/super/edit/{id}',array('uses' => 'UsersController@getEditadmin'));*/
});

/**
 * Aquí empieza todo
 */
Route::get('/', function() {
    return Redirect::to('user/home');
});

/**
 * Si intentan hacer login desde /login, los redirigimos a la página correcta
 */
Route::get('login', function() { return Redirect::to('user/login'); });
Route::get('store/', array('uses' => 'StoresController@index'));
Route::get('stores/', array('uses' => 'StoresController@listado'));

Route::get('store/new', array('uses' => 'StoresController@newStore'));
Route::post('store/new', array('uses' => 'StoresController@postNewStore'));

Route::get('store/{id}', array('uses' => 'StoresController@storeView'));
Route::get('store/{id}/products/', array('uses' => 'StoresController@products'));

Route::get('products/', array('uses' => 'ProductsController@index'));
/**
 * Aquí se cargan los controladores RESTful
 */
Route::controller('user','UsersController');
Route::controller('password','RemindersController');
//Route::controller('store','StoresController');
//Route::get('user', function() { return Redirect::to('user/home'); });
//Route::controller('admin','AdminController');
/*
 * View Composer 
 * Crea un objeto $user que es usado siempre que se invoca la plantilla layout/main.blade.php
 */
View::composer(array('layout.main', 'users.home'), function($view) {
    $view->with('user',  Auth::user());
});

