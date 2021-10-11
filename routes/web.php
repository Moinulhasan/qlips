<?php

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

Route::get("/topics",[ViewController::class,'topic'])->name("topics");
Route::get("/questions",[ViewController::class,'questions'])->name("questions");