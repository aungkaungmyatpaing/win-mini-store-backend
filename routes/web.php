<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\ProfileController;
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
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/admin-login', [AuthController::class, 'userLogin'])->name('userLogin');

require __DIR__.'/backend.php';
// require __DIR__.'/auth.php';
