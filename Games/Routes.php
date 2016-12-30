<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Nova the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'admin', 'namespace' => 'App\Modules\Games\Controllers\Admin'), function() {
    Route::get( 'games/types',        array('before' => 'auth',      'uses' => 'Types@index'));
    Route::get( 'games/types/create', array('before' => 'auth',      'uses' => 'Types@create'));
    Route::post('games/types',              array('before' => 'auth|csrf', 'uses' => 'Types@store'));
    Route::get( 'games/types/{id}/edit',    array('before' => 'auth',      'uses' => 'Types@edit'));
    Route::post('games/types/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Types@destroy'));
    Route::post('games/types/{id}',         array('before' => 'auth|csrf', 'uses' => 'Types@update'));

    Route::get( 'games/platforms',        array('before' => 'auth',      'uses' => 'Platforms@index'));
    Route::get( 'games/platforms/create', array('before' => 'auth',      'uses' => 'Platforms@create'));
    Route::post('games/platforms',              array('before' => 'auth|csrf', 'uses' => 'Platforms@store'));
    Route::get( 'games/platforms/{id}/edit',    array('before' => 'auth',      'uses' => 'Platforms@edit'));
    Route::post('games/platforms/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Platforms@destroy'));
    Route::post('games/platforms/{id}',         array('before' => 'auth|csrf', 'uses' => 'Platforms@update'));

    Route::get( 'games',              array('before' => 'auth',      'uses' => 'Games@index'));
    Route::get( 'games/create',       array('before' => 'auth',      'uses' => 'Games@create'));
    Route::post('games',              array('before' => 'auth|csrf', 'uses' => 'Games@store'));
    Route::get( 'games/{id}/edit',    array('before' => 'auth',      'uses' => 'Games@edit'));
    Route::post('games/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Games@destroy'));
    Route::post('games/{id}',         array('before' => 'auth|csrf', 'uses' => 'Games@update'));
});

Route::group(array('prefix' => '', 'namespace' => 'App\Modules\Games\Controllers'), function() {
    Route::get( 'games', array('uses' => 'Games@index'));
});
