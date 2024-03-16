<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

/*
** RUTAS PANEL ADMINISTRADOR **
*/

Route::get('/panel', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/panel/login', [AuthController::class, 'index'])->name('login');

Route::post('/panel/login', [AuthController::class, 'login'])->name('login');
Route::post('/panel/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/panel/personal', [PersonaController::class, 'index']);
Route::post('/panel/personal/create', [PersonaController::class, 'create']);
Route::get('/panel/personal/list', [PersonaController::class, 'list']);

Route::get('/panel/vehiculo', [VehiculoController::class, 'index']);
Route::post('/panel/vehiculo/create', [VehiculoController::class, 'create']);
Route::get('/panel/vehiculo/list', [VehiculoController::class, 'list']);

Route::get('/panel/users', [UserController::class, 'index']);
Route::post('/panel/users/create', [UserController::class, 'create']);
Route::get('/panel/users/list', [UserController::class, 'list']);

Route::get('/panel/page/{page}', [PageController::class, 'index']);
Route::get('/panel/logados', [AuthController::class, 'logados'])->name('logados');


/**
 ** RUTAS PUBLICAS **
 */
// Route::get('/', [PageController::class, 'home']);
Route::get('/', [PageController::class, 'index']);
