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

Auth::routes();

Route::get('/log_out', 'AuthController@logout');

Route::get('/projectsheets', 'ProjectController@printProjectSheets');
Route::get('/projectsheet/{id}', 'ProjectController@printSingleProjectSheet');

# Vue
Route::any('{all}', function () {
    return view('welcome');
})
    ->where(['all' => '.*']);




//Route::get('/', function() {
//    return view('welcome');
//});
//
//Route::get('/app/{catchall?}', function () {
//    return response()->view('welcome');
//})->where('catchall', '(.*)');
//
//Route::get('/admin/{catchall?}', function () {
//    return response()->view('welcome');
//})->where('catchall', '(.*)');
////

