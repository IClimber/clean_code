<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
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

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/', [ArticleController::class, 'store']);

    Route::prefix('{article}/comments')->group(function () {
        Route::get('/', [CommentController::class, 'index']);
        Route::post('/', [CommentController::class, 'store']);
        Route::delete('/{comment}', [CommentController::class, 'destroy']);
    });
});
