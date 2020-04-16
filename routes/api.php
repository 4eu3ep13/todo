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

        //Tasks
        Route::get('/tasks/notFinished/{id}/{column}/{par}', 'TaskController@notFinishedTasks');    //Not Finished  (ID - пользователь)
        Route::get('/tasks/finished/{id}/{column}/{par}', 'TaskController@finishedTasks');          //Finished      (ID - пользователь)
        Route::get('/tasks/{id}/{column}/{par}', 'TaskController@tasks');                           //All           (ID - пользователь)
        Route::post('/task/create/{id}', 'TaskController@create');                   //Create        (ID - пользователь)
        Route::post('/task/edit/{id}', 'TaskController@edit');                       //Edit          (ID - задача)
        Route::post('/task/delete/{id}','TaskController@delete');                    //Delete        (ID - задача)
        Route::put('/task/finished/{id}','TaskController@finished');                 //Finished      (ID - задача)
        Route::put('/task/notFinished/{id}','TaskController@notFinished');           //Unfinished    (ID - задача) (ОТВЕТ??)


        //Subtasks
        Route::get('/subtasks/{id}', 'SubtaskController@subtasks');                  //List          (ID - задача) (обратный хронологический порядок)
        Route::post('/subtask/create/{id}', 'SubtaskController@create');             //Create        (ID - задача)
        Route::post('/subtask/edit/{id}', 'SubtaskController@edit');                 //Edit          (ID - подзадача)
        Route::post('/subtask/delete/{id}','SubtaskController@delete');              //Delete        (ID - подзадача)
        Route::put('/subtask/finished/{id}','SubtaskController@finished');           //Finished      (ID - подзадача)
        Route::put('/subtask/notFinished/{id}','SubtaskController@notFinished');     //Unfinished    (ID - подзадача)
    });
