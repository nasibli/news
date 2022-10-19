<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\NewsCommentController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('news/{news}', [NewsController::class, 'get']);
    Route::get('news/{news}/comments', [NewsCommentController::class, 'index']);
    Route::post('news/{news}/comments/{comment?}', [NewsCommentController::class, 'create']);
});
