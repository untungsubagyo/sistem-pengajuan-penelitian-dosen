<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('welcome');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'action'])->name('login-action');

Route::get('/user/reviewer', [ReviewerController::class, 'index'])->name('reviewer');