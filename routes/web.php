<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login','Auth\AuthController@index')->name('login');
Route::post('/auth','Auth\AuthController@auth');
Route::get('/logout','Auth\AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () use ($router) {
    $router->get('/', function(){
        return view('welcome');
    });
});