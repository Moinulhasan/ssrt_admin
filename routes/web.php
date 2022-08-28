<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'webLogin'])->name('web.login');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout',[AuthController::class,'webLogout'])->name('logout');
    Route::get('/home',[DashboardController::class,'index'])->name('dashboard');
});
