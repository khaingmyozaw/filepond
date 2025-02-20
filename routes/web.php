<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
});
Route::post('/upload', function() {
    // 
})->name('upload');
