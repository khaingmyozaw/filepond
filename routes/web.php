<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
});
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
Route::post('/upload/process', [FileUploadController::class, 'process'])->name('upload');
