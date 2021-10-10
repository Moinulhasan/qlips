<?php

use App\Http\Controllers\status\StatusController;
use App\Http\Controllers\topic\TopicController;
use Illuminate\Database\Console\Migrations\StatusCommand;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// status
Route::post('/create-status',[StatusController::class,'create']);
Route::get('/get-all-status',[StatusController::class,'getAllStatus']);

/// topic
Route::prefix('topic')->group(function ($app){
    Route::post('/create',[TopicController::class,'create']);
    Route::get('/get-all',[TopicController::class,'getAll']);
});
