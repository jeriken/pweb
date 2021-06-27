<?php

use App\Http\Controllers\PictureController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
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

Route::group([
    'prefix' => 'users'
], function () {
    Route::post('register', [UserController::class, 'store']);
    Route::post('login', [UserController::class, 'login']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('show/{id}', [UserController::class, 'show']);
        Route::get('index', [UserController::class, 'index']);
    });
});

Route::group([
    'prefix' => 'picture'
], function () {
    Route::get('index', [PictureController::class, 'index']);
    Route::get('show/{id}', [PictureController::class, 'index']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('store', [PictureController::class, 'store']);
        Route::put('update/{id}', [PictureController::class, 'update']);
        Route::delete('delete/{id}', [PictureController::class, 'destroy']);
    });
});


Route::middleware('auth:api')->group(function () {
    // Category
    Route::resource('category', CategoryController::class);
    // Picture
    Route::resource('picture', PictureController::class);
    // Bookmark
    Route::resource('bookmark', BookmarkController::class);
    // Like
    Route::resource('like', LikeController::class);
    // Favorite
    Route::resource('favorite', FavoriteController::class);
});
