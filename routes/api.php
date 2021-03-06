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
    Route::get('/contents', 'ContentController@index');
    Route::get('/content/{id}', 'ContentController@show');

    Route::post('submit-project','ProjectController@store');
    Route::get('/open-projects', 'ProjectController@open_projects');
    Route::get('/project-categories', 'ProjectCategoryController@index');

    Route::get('/project/{id}', 'ProjectController@show');
    Route::get('projects/serving', 'ProjectController@myProjects');

    Route::post('/project/{project_id}/server','ServerController@store');

    Route::get('/project/{id}', 'ProjectController@show');

    Route::post('/project/{project_id}/server', 'ProjectController@store_project_server');
});


Route::group(['middleware' => 'auth:api'], function() {

    // stats
    Route::get('/stats', 'ContentController@stats');

    // content
    Route::get('/content/{id}', 'ContentController@show');
    Route::delete('content/{id}','ContentController@destroy');
    Route::put('content/{id}','ContentController@update');
    Route::post('content','ContentController@store');

    // churches
    Route::get('/church/{id}', 'ChurchController@show');
    Route::delete('church/{id}','ChurchController@destroy');
    Route::put('church/{id}','ChurchController@update');
    Route::post('church','ChurchController@store');

    // servers
    Route::get('/server/{id}', 'ChurchController@show');
    Route::delete('server/{id}','ChurchController@destroy');
    Route::put('server/{id}','ChurchController@update');

    // projects
    Route::get('/projects', 'ProjectController@index');
    Route::delete('project/{id}','ProjectController@destroy');
    Route::put('project/{id}','ProjectController@update');
    Route::post('project','ProjectController@store');

    // Project Volunteers
    Route::get('/user/projects', 'UserController@getProjects');
    Route::get('/volunteers', 'UserController@getVolunteers');
    Route::get('/project/{id}/servers', 'ProjectController@project_servers');
    Route::delete('/project/{project_id}/server/{user_id}', 'ProjectController@delete_project_server');

    //Route::post('/project/{project_id}/volunteer', 'ProjectController@store_project_volunteer');
    //Route::post('/project/{project_id}/group/{group_id}', 'ProjectController@store_project_group');

    // Project Groups
    Route::get('/project/{id}/groups', 'ProjectController@project_groups');
    Route::delete('/project/{project_id}/group/{group_id}', 'ProjectController@delete_project_group');

//    Route::get('/project-categories', 'ProjectCategoryController@index');

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

    // evaluators
    Route::get('/evaluators', 'EvaluatorController@index');

    // coordinators
    Route::get('/coordinators', 'CoordinatorController@index');

    // roles
    Route::get('/roles', 'RoleController@index');

});
