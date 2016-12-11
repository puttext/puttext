<?php

use App\Http\Controllers\OrdiniController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource("ordini","OrdiniController");
Route::get('ordini/pane/{anno}/{mese}/edit', 'PaneController@edit');
Route::post('ordini/pane/{anno}/{mese}', 'PaneController@update');
