<?php

use App\Http\Controllers\CapaianController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TimController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');

//Dosen Router
Route::resource('dosen/manage_proposal', ProposalController::class);
Route::resource('dosen/manage_tim', TimController::class);
Route::resource('dosen/manage_luaran', CapaianController::class);