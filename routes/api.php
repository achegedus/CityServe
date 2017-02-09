<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['middleware' => 'api'], function() {
    Route::get('/churches', 'ChurchController@index');
});


Route::group(['middleware' => 'auth:api'], function() {
    // churches
    Route::get('/church/{id}', 'ChurchController@show');
    Route::delete('church/{id}','ChurchController@destroy');
    Route::put('church/{id}','ChurchController@update');
    Route::post('church','ChurchController@store');

});
