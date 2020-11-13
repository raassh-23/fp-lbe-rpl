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
})->name('welcome');

Auth::routes();

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function() {
	// Home
    Route::get('/', 'AdminController@showHome')->name('admin');
    // List
    Route::get('/game', 'GameController@showGameList')->name('admin.game.list');
    // Details
    Route::get('/game/details/{game_id}', 'GameController@showDetailsPageAdmin')->name('admin.game.details');
    // Create
    Route::get('/game/create', 'GameController@showCreatePage')->name('admin.game.create');
    Route::post('/game/create', 'GameController@createGame')->name('admin.game.create.process');
    // Edit
    Route::get('/game/edit/{game_id}', 'GameController@showEditPage')->name('admin.game.edit');
    Route::post('/game/edit/{game_id}', 'GameController@editGame')->name('admin.game.edit.process');

    Route::get('/game/delete/{game_id}', 'GameController@showDeletePage')->name('admin.game.delete');
    Route::delete('/game/delete/{game_id}', 'GameController@deleteGame')->name('admin.game.delete.process');
});

Route::get('gameImage/{imageName}', 'GameController@getGameImage')->name('gameImage');
Route::get('platformImage/{imageName}', 'GameController@getPlatformImage')->name('platformImage');

Route::prefix('/user')->middleware(['auth',])->group(function() {
    // List
    Route::get('/game', 'GameController@showGameListUser')->name('user.game.list');
    // Details
    Route::get('/game/view/{game_code}', 'GameController@showDetailsPageUser')->name('user.game.details');
    
    Route::get('/review/create/{game_code}', 'ReviewController@showCreatePage')->name('user.review.create');
    Route::post('/review/create/{game_code}', 'ReviewController@CreateReview')->name('user.review.create.process');

    Route::get('/review/edit/{game_code}', 'ReviewController@showEditPage')->name('user.review.edit');
    Route::post('/review/edit/{game_code}', 'ReviewController@editReview')->name('user.review.edit.process');

    Route::get('/review/delete/{game_code}', 'ReviewController@showDeletePage')->name('user.review.delete');
    Route::delete('/review/delete/{game_code}', 'ReviewController@deleteReview')->name('user.review.delete.process');
});
