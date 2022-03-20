<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/character')->group(function () {
        Route::post('/create', [CharacterController::class, 'create']);
        Route::get('/getAll', [CharacterController::class, 'getAll']);
        Route::get('{character}/delete', [CharacterController::class, 'delete']);
    });
    Route::get('/leaderboards', [LeaderboardsController::class, 'get']);
});
