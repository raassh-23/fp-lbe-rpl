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

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function() {
    // List
    Route::get('/game', 'GameController@showGameList')->name('admin.game.list');
    // Create
    Route::get('/game/create', 'GameController@showCreatePage')->name('admin.game.create');
    Route::post('/game/create', 'GameController@createGame')->name('admin.game.create.process');
    Route::get('/game/edit/{game_id}', 'GameController@showEditPage')->name('admin.game.edit');
    Route::post('/game/edit/{game_id}', 'GameController@editGame')->name('admin.game.edit.process');
});
Route::get('gameImage/{imageName}', 'GameController@getGameImage')->name('gameImage');
