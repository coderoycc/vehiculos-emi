<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\QrregistroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
// Route::get('/vehiculo/{hash}', [VehiculoController::class, 'getByHash']);
Route::post('/user/login', [UserController::class, 'loginApi']);
// Route::post('/registro/create', [RegistroController::class, 'create']);
Route::get('/qr/{hash}', [QrregistroController::class, 'verificarqr']);
// Route::post('/qrregister/register', []);
Route::post('/qr/register', [QrregistroController::class, 'registrar']);
Route::get('/qr/getqr/{id}', [QrregistroController::class, 'generarqr']);
Route::post('/guest/create_entry', [GuestController::class, 'create_entry']);
Route::post('/vehiculo/upload-doc', [VehiculoController::class, 'update_document']);