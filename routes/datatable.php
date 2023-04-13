<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// DataTable
Route::get('data-user', [UserController::class, 'dataTable'])->name('user.data');
Route::get('data-label',[App\Http\Controllers\LabelController::class,'dataTable'])->name('label.data');
Route::get('data-donatur',[App\Http\Controllers\DonaturController::class,'dataTable'])->name('donatur.data');
