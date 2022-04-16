<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::get('posts/{slug}/download-all-documents', [App\Http\Controllers\PostController::class, 'downloadAllDocuments'])->name('posts.download-all-documents');
    Route::get('posts/{slug}/{media}/download', [App\Http\Controllers\PostController::class, 'downloadADocument'])->name('posts.download-a-document');
    Route::resource('comments', App\Http\Controllers\CommentController::class)->only(['index', 'store', 'destroy']);
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
});
