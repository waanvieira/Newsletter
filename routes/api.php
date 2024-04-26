<?php

use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NewsLetterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user', UserController::class);
Route::resource('newsletter',NewsLetterController::class);
Route::group(['prefix' => 'newsletter', 'as' => 'newsletter.'], function () {
    Route::put('link_user/{id}', [NewsLetterController::class,'registerUserOnTheList'])->name('link_user');
});
Route::resource('message', MessageController::class);
