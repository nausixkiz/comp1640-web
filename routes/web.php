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
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/', [App\Http\Controllers\HomeController::class, 'indexSorted'])->name('home.sorted');

    Route::middleware(['role:Staff'])->group(function () {
        Route::resource('ideas', App\Http\Controllers\IdeaController::class)->except(['show', 'destroy']);

        Route::prefix('ideas')->group(function (){
            Route::post('{idea}/comment', [App\Http\Controllers\IdeaController::class, 'storeComment'])->name('ideas.store-comment');
            Route::get('{idea}/download-all-documents', [App\Http\Controllers\IdeaController::class, 'downloadAllDocuments'])->name('ideas.download-all-documents');
            Route::get('{idea}/{media}/download', [App\Http\Controllers\IdeaController::class, 'downloadADocument'])->name('ideas.download-a-document');
            Route::put('{idea}/like', [App\Http\Controllers\IdeaController::class, 'like'])->name('ideas.like');
            Route::delete('{idea}/remove-like', [App\Http\Controllers\IdeaController::class, 'removeLike'])->name('ideas.remove-like');
            Route::put('{idea}/dislike', [App\Http\Controllers\IdeaController::class, 'dislike'])->name('ideas.dislike');
            Route::delete('{idea}/remove-dislike', [App\Http\Controllers\IdeaController::class, 'removeDislike'])->name('ideas.remove-dislike');
        });
    });

    Route::get('ideas/{idea}', [App\Http\Controllers\HomeController::class, 'showIdea'])->name('ideas.show');

    Route::middleware(['role:Quality Assurance Manager'])->group(function () {
        Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', App\Http\Controllers\CategoryController::class)->except(['show']);
        Route::get('categories/export-csv', [App\Http\Controllers\CategoryController::class, 'exportCSV'])->name('categories.export.csv');
        Route::get('categories/export-zip', [App\Http\Controllers\CategoryController::class, 'exportZip'])->name('categories.export.zip');
    });
});
