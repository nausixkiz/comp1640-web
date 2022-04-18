<?php

use App\Http\Controllers\Api\DevController;
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

Route::group(['role:Super Administrator'], function () {
    Route::resource('users', \App\Http\Controllers\Manage\UserController::class)->except(['show']);
    Route::resource('departments', \App\Http\Controllers\Manage\DepartmentController::class)->except(['create', 'show']);
    Route::resource('posts', \App\Http\Controllers\Manage\PostController::class)->only(['index', 'destroy']);
    Route::resource('comments', App\Http\Controllers\CommentController::class)->only(['index', 'destroy']);
});
