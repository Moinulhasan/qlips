<?php

use App\Http\Controllers\advisor\AdvisorController;
use App\Http\Controllers\customAuth\CustomAuthController;
use App\Http\Controllers\question\QuestionController;
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
//register api
Route::post('/super-admin-register',[CustomAuthController::class,'superAdminRegister']);
/// topic
Route::prefix('topic')->group(function (){
    Route::post('/create',[TopicController::class,'create']);
    Route::get('/get-all',[TopicController::class,'getAll']);
});

//question
Route::prefix('question')->group(function (){
    Route::get('/get-all',[QuestionController::class,'getAllQuestion']);
});
Route::prefix('advisor')->group(function (){
    Route::get('/featured',[AdvisorController::class,'getAllFeatured']);
});
Route::post('/authenticate',[CustomAuthController::class,'Authorization']);
