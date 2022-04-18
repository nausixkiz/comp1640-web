<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Manage\DepartmentController;
use App\Http\Controllers\Manage\PostController;
use App\Http\Controllers\Manage\UserController;
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

Route::middleware(['role:Super Administrator'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('departments', DepartmentController::class)->except(['create', 'show']);
    Route::resource('posts', PostController::class)->only(['index', 'destroy']);
    Route::resource('comments', CommentController::class)->only(['index', 'destroy']);
});
