<?php

use App\Http\Controllers\PictureController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Resources\Category;
use App\Http\Resources\Favorite;

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
        Route::post('update/{id}', [UserController::class, 'update']);
    });
});

Route::group([
    'prefix' => 'bookmark'
], function () {
    Route::get('index', [BookmarkController::class, 'index']);
    Route::get('show/{id}', [BookmarkController::class, 'index']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('store', [BookmarkController::class, 'store']);
        Route::post('update/{id}', [BookmarkController::class, 'update']);
        Route::delete('delete/{id}', [BookmarkController::class, 'destroy']);
    });
});

Route::group([
    'prefix' => 'category'
], function () {
    Route::get('index', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'index']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('store', [CategoryController::class, 'store']);
        Route::post('update/{id}', [CategoryController::class, 'update']);
        Route::delete('delete/{id}', [CategoryController::class, 'destroy']);
    });
});

Route::group([
    'prefix' => 'like'
], function () {
    Route::get('index', [LikeController::class, 'index']);
    Route::get('show/{id}', [LikeController::class, 'index']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('store', [LikeController::class, 'store']);
        Route::post('update/{id}', [LikeController::class, 'update']);
        Route::delete('delete/{id}', [LikeController::class, 'destroy']);
    });
});

Route::group([
    'prefix' => 'favorite'
], function () {
    Route::get('index', [FavoriteController::class, 'index']);
    Route::get('show/{id}', [FavoriteController::class, 'index']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('store', [FavoriteController::class, 'store']);
        Route::post('update/{id}', [FavoriteController::class, 'update']);
        Route::delete('delete/{id}', [FavoriteController::class, 'destroy']);
    });
});

Route::group([
    'prefix' => 'picture'
], function () {
    Route::get('index', [PictureController::class, 'index']);
    Route::get('post/{id}', [PictureController::class, 'postby']);
    Route::get('show/{id}', [PictureController::class, 'show']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('store', [PictureController::class, 'store']);
        Route::post('update/{id}', [PictureController::class, 'update']);
        Route::delete('delete/{id}', [PictureController::class, 'destroy']);
    });
});