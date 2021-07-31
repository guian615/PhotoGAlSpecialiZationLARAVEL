<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [App\Http\Controllers\ImageController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/image', [App\Http\Controllers\ImageController::class, 'post'])->name('post');

Route::put('/image/{image}', [App\Http\Controllers\EditController::class, 'update'])->name('image.update');
Route::get('/image/{image}/edit', [App\Http\Controllers\EditController::class, 'edit'])->name('edit');

Route::delete('/image/{id}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('destroy');
