<?php

use App\Http\Controllers\UserController;
use App\Models\CatEye;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('/donatur-export', [App\Http\Controllers\DonaturController::class, 'export'])->name('donatur.export');
    Route::resource('label',App\Http\Controllers\LabelController::class);
    Route::resource('donatur',App\Http\Controllers\DonaturController::class);
    Route::resource('user',App\Http\Controllers\UserController::class)->except('show');
});
Route::resource('user',App\Http\Controllers\UserController::class)->only('show');
