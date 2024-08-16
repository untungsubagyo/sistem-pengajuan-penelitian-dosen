<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ReviewerController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'action'])->name('login-action');

Route::get('/', [PengumumanController::class, 'index'])->name('welcome');
Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
Route::get('admin/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
Route::post('admin/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('admin/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('admin/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

Route::get('/user/reviewer/home/{q?}', [ReviewerController::class, 'index'])->name('reviewer');
Route::get('/user/reviewer/review/{id}', [ReviewerController::class, 'review'])->name('review');
Route::get('/user/reviewer/draf', [ReviewerController::class, 'viewAllDraft'])->name('reviewer.viewAllDraf');
Route::delete('/user/reviewer/draf/delete/{id_review_proposal}', [ReviewerController::class, 'deleteReview'])->name('reviewer.delete');
Route::post('/user/reviewer/review/{id_proposal}', [ReviewerController::class, 'postReview'])->name('post-review');