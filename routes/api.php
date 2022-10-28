<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('user', [UserController::class, 'getAll']);
Route::get('user/{id}', [UserController::class, 'getUser']);
Route::post('user', [UserController::class, 'store']);
Route::post('user/{id}', [UserController::class, 'destroy']);

Route::group([
    'prefix' => 'auth'
], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('data', [AuthController::class, 'data']);

        Route::get('todo', [TodoController::class, 'getAll']);
        Route::post('todo', [TodoController::class, 'createTodo']);
        Route::post('todo/{id}', [TodoController::class, 'updateTodo']);
        Route::post('todo/{id}', [TodoController::class, 'deleteTodo']);
    });
});


