<?php

use App\Http\Controllers\advisor\AdvisorController;
use App\Http\Controllers\clips\ClipsController;
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


///

// advisor
Route::prefix('advisor')->group(function (){
    Route::get('/featured',[AdvisorController::class,'getAllFeatured']);
    Route::get('/get-all',[AdvisorController::class,'getAllAdvisor']);
});

// clips
Route::prefix('clips')->group(function (){
    Route::get('/get-all',[ClipsController::class,'getAll']);
    Route::get('/question/{id}',[ClipsController::class,'getQuestionClips']);
    Route::get('/advisor/{id}',[ClipsController::class,'getAdvisorClips']);
    Route::get('/recent',[ClipsController::class,'recentClips']);
    Route::get('/topic/{id}',[ClipsController::class,'topicClips']);
});

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/upvote/{id}',[ClipsController::class,'updateUpvote']);
    Route::post('/listening/{id}',[ClipsController::class,'updateListeningItem']);

    //question
    Route::prefix('question')->group(function (){
        Route::get('/get-all',[QuestionController::class,'getAllQuestion']);
        Route::get('/clips',[QuestionController::class,'questionClips']);
        Route::get('/recent-clips',[QuestionController::class,'recentQuestionClips']);
        Route::get('/topic-clips/{id}',[QuestionController::class,'topicQuestionClips']);

    });

});

Route::post('/authenticate',[CustomAuthController::class,'Authorization']);
Route::get('/test',[QuestionController::class,'testTopic']);
