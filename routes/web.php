<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/personal', [PersonaController::class, 'index']);
Route::post('/personal/create', [PersonaController::class, 'create']);



Route::get('/vehiculo', [VehiculoController::class, 'index']);
Route::get('/page/{page}', [PageController::class, 'index']);

Route::get('/logados', [AuthController::class, 'logados'])->name('logados');
