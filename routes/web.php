<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::resource('admin/pengumuman', PengumumanController::class);
Route::get('admin/pengumuman/form', [PengumumanController::class, 'form'])->name('pengumuman.form');