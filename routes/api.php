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

Route::group(['middleware' => 'api'], function() {
    Route::get('/churches', 'ChurchController@index');
});


Route::group(['middleware' => 'auth:api'], function() {
    // churches
    Route::get('/church/{id}', 'ChurchController@show');
    Route::delete('church/{id}','ChurchController@destroy');
    Route::put('church/{id}','ChurchController@update');
    Route::post('church','ChurchController@store');

    // projects
    Route::get('/projects', 'ProjectController@index');
    Route::get('/project/{id}', 'ProjectController@show');
    Route::delete('project/{id}','ProjectController@destroy');
    Route::put('project/{id}','ProjectController@update');
    Route::post('project','ProjectController@store');

    // people
    Route::get('/people', 'PersonController@index');
    Route::get('/people/{id}', 'PersonController@show');
    Route::delete('person/{id}','PersonController@destroy');
    Route::put('person/{id}','PersonController@update');
    Route::post('person','PersonController@store');

    // users
    Route::get('/users', 'UserController@index');
    Route::get('/user', 'UserController@profile');
    Route::get('/user/{id}', 'UserController@show');
    Route::delete('user/{id}','UserController@destroy');
    Route::put('user/{id}','UserController@update');
    Route::post('user','UserController@store');

    // groups
    Route::get('/groups', 'GroupController@index');
    Route::get('/group/{id}', 'GroupController@show');
    Route::delete('group/{id}','GroupController@destroy');
    Route::put('group/{id}','GroupController@update');
    Route::post('group','GroupController@store');

    // group_types
    Route::get('/group_types', 'GroupTypeController@index');
    Route::get('/group_type/{id}', 'GroupTypeController@show');
    Route::delete('group_type/{id}','GroupTypeController@destroy');
    Route::put('group_type/{id}','GroupTypeController@update');
    Route::post('group_types','GroupTypeController@store');

    // roles
    Route::get('/roles', 'RoleController@index');

});
