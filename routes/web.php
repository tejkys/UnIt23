<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'show'])->name('index');
Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/test', [\App\Http\Controllers\TestingController::class, 'get'])->name('testing.get');
