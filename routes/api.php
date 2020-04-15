<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@authenticate');
Route::post('/register', 'RegisterController@register');


Route::middleware(['jwt.auth'])->group(function ()
    {
        //Dockets
        Route::get('/dockets/{id}', 'DocketController@dockets');        //List
        Route::post('/docket/create/{id}', 'DocketController@create');  //Create
        Route::post('/docket/edit/{id}', 'DocketController@edit');      //Edit

        //Tasks
        Route::get('/tasks/{id}', 'TaskController@tasks');
        Route::post('/task/create/{id}', 'TaskController@create');
        Route::post('/task/edit/{id}', 'TaskController@edit');

        //Subtasks
        Route::get('/subtasks/{id}', 'SubtaskController@tasks');
        Route::post('/subtask/create/{id}', 'SubtaskController@create');
        Route::post('/subtask/edit/{id}', 'SubtaskController@edit');
    });
