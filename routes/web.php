<?php

use App\Http\Controllers\customAuth\CustomAuthController;
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

    Route::get("/questions",[ViewController::class,'questions'])->name("questions");
    Route::get("/advisor",[ViewController::class,'advisor'])->name("advisor");
    Route::get("/audio-clips",[ViewController::class,'audioClips'])->name("audioClips");
    Route::get("/audio-upload",[ViewController::class,'uploadAudio'])->name("uploadAudio");
});

