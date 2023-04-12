<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestingController;
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

Route::get('/test/get', [TestingController::class, 'get'])->name('testing.get');
Route::post('/test/post', [TestingController::class, 'post'])->name('testing.post');
Route::get('/test', [TestingController::class, 'view'])->name('testing.view');
