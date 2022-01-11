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
        return view('dashboard.index');
    });

    //TIM
    $router->get('/tim','TimController@index');
    $router->get('/team-data','TimController@datatables');
    $router->post('/tim/store','TimController@store');
    $router->get('/tim/delete/{id}','TimController@delete');

    //PLAYERS
    $router->get('/tim-data/player-list/{id}','PlayerController@list_by_team');
    $router->get('/player-by-tim/{id}','PlayerController@get_player_by_team');
    $router->post('/player/store','PlayerController@store');
    $router->post('/player/transfer','PlayerController@transfer');
    $router->get('/player/delete/{id}','PlayerController@delete');

    //JADWAL
    $router->get('/jadwal','JadwalController@index');
    $router->get('/get/jadwal','JadwalController@datatables');
    $router->post('/jadwal/store','JadwalController@store');
    $router->get('/jadwal/delete/{id}','JadwalController@delete');

    $router->get('/statistic','StatisticController@index');
    $router->get('/statistic/match','StatisticController@get_match');
});