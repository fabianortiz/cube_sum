<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * RUTA '/':
 * Home del sitio
 */

Route::get('/', ['uses' => 'SummationController@index']);
Route::post('summation', ['as' => 'summation','uses' => 'SummationController@makeSummation']);




