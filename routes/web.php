<?php

use App\Http\Controllers\BattleSimulatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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
});

Route::get('/event-creator', function () {
    return view('event-creator');
});

Route::get('/battle-simulator', [BattleSimulatorController::class, 'getView']);
Route::post('/battle-simulator/submit', [BattleSimulatorController::class, 'simulate']);

Route::post('/event-creator/submit', [EventController::class, 'createEvent']);