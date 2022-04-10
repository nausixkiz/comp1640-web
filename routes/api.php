<?php

use App\Http\Controllers\Api\DevController;
use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
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

Route::get('/bump-data', [DevController::class, 'bumpData']);

Route::post('document-upload', [FileController::class, 'uploadDocument'])->name('api.document-upload');
