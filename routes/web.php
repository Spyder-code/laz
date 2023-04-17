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
Route::prefix('admin')->middleware(['admin','auth'])->group(function () {
    Route::post('/donatur-export', [App\Http\Controllers\DonaturController::class, 'export'])->name('donatur.export');
    Route::post('/donatur-add/{user}', [App\Http\Controllers\UserController::class, 'addDonatur'])->name('user.add.donatur');
    Route::resource('label',App\Http\Controllers\LabelController::class);
    Route::resource('donatur',App\Http\Controllers\DonaturController::class)->except(['show','update']);
    Route::resource('user',App\Http\Controllers\UserController::class)->except(['show','update','edit']);
});

Route::middleware('auth')->group(function(){
    Route::resource('donatur',App\Http\Controllers\DonaturController::class)->only(['show','update']);
    Route::resource('user',App\Http\Controllers\UserController::class)->only(['show','update','edit']);
});
