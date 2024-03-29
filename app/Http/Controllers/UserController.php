<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

  public function create(Request $request) {
    $user = new User();
    $user->nombre = $request->nombre;
    $user->usuario = $request->usuario;
    $user->rol = $request->rol;
    $user->ci = $request->ci;
    $user->password = bcrypt($request->usuario);
    if ($user->save()) {
      return response()->json(['status' => true, 'message' => 'Usuario creado con exito'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Error al crear usuario'], 500);
    }
  }
  public function loginApi(Request $request) {
    $user = User::where('usuario', $request->usuario)->first();
    if ($user) {
      if (password_verify($request->password, $user->password)) {
        return response()->json(['status' => true, 'message' => 'Login correcto', 'data' => $user], 200);
      } else {
        return response()->json(['status' => false, 'message' => 'Contraseña incorrecta'], 401);
      }
    } else {
      return response()->json(['status' => false, 'message' => 'Usuario no encontrado'], 404);
    }
  }
  public function list() {
    $users = User::all();
    return response()->json(['data' => $users, 'status' => true]);
  }
  public function index() {
    return view('user.index');
  }
}
