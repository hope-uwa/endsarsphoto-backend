<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search', [SearchController::class, 'index']);
Route::get('/states', [StateController::class, 'index']);

Route::get('/login/redirect', [LoginController::class, 'redirectToProvider']);
Route::post('/login/callback', [LoginController::class, 'handleProviderCallback']);


Route::group(['middleware' => ['auth:api']], function() {

    Route::get('/post', [PostController::class, 'index']);
    Route::get('/post/{id}', [PostController::class, 'show']);
    Route::post('/post', [PostController::class, 'create']);
    Route::put('/post/{id}', [PostController::class, 'update']);
    Route::delete('/post/{id}', [PostController::class, 'destroy']);

    Route::get('post/{postId}/picture', [PictureController::class, 'index']);
    Route::get('post/{postId}/picture/{pictureId}', [PictureController::class, 'show']);
    Route::post('post/{postId}/picture', [PictureController::class, 'store']);
    Route::delete('post/{postId}/picture/{pictureId}', [PictureController::class, 'destroy']);
});
