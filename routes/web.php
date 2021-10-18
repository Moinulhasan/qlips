<?php

use App\Http\Controllers\advisor\AdvisorController;
use App\Http\Controllers\customAuth\CustomAuthController;
use App\Http\Controllers\question\QuestionController;
use App\Http\Controllers\register\AuthenticationWebController;
use App\Http\Controllers\topic\TopicController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[AuthenticationWebController::class,'login'])->name('login');
Route::post('/login',[CustomAuthController::class,'login'])->name('login.post');
Route::group(['middleware'=>['auth','superAdmin']],function (){
    Route::prefix('topics')->group(function(){
        Route::get("/",[TopicController::class,'index'])->name("topics");
        Route::post('/create',[TopicController::class,'createTopic'])->name('topics.create');
        Route::post('/update-status',[TopicController::class,'topicStatusChange'])->name('topic.status.update');
    });

    Route::prefix('questions')->group(function (){
        Route::get("/",[QuestionController::class,'index'])->name("questions");
        Route::post('/store',[QuestionController::class,'createQuestion'])->name('questions.store');
        Route::post('/update-status',[QuestionController::class,'questionStatusUpdate'])->name('questions.status.update');
    });
    Route::prefix('advisor')->group(function (){
        Route::get("/",[AdvisorController::class,'index'])->name("advisor");
        Route::post('/store',[AdvisorController::class,'store'])->name('store.advisor');
        Route::post('/update-status',[AdvisorController::class,'advisorUpdate'])->name('advisor.status.update');
    });


    Route::get("/audio-clips",[ViewController::class,'audioClips'])->name("audioClips");
    Route::get("/audio-upload",[ViewController::class,'uploadAudio'])->name("uploadAudio");
});

