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
    $user->state = 1;
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
    $users = User::where('state', 1)->get();
    return response()->json(['data' => $users, 'status' => true]);
  }
  public function index() {
    return view('user.index');
  }
  public function delete(Request $req) {
    $user = User::find($req->user_id);
    if ($user) {
      $user->state = 0;
      if ($user->save()) {
        return response()->json(['status' => true, 'message' => 'Usuario dado de baja con exito'], 200);
      } else {
        return response()->json(['status' => false, 'message' => 'Error al dar de baja al usuario'], 500);
      }
    } else {
      return response()->json(['status' => false, 'message' => 'Usuario no encontrado'], 200);
    }
  }
  public function edit_content($id) {
    $user = User::find($id);
    $view = view('user.edit_content', compact('user'))->render();
    return response()->json(['html' => $view, 'status' => true]);
  }
  public function update(Request $request) {
    $user = User::find($request->user_id);
    $user->nombre = $request->nombre;
    $user->usuario = $request->usuario;
    $user->rol = $request->rol;
    $user->ci = $request->ci;
    if ($user->save()) {
      return response()->json(['status' => true, 'message' => 'Usuario actualizado con exito'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Error al actualizar usuario'], 500);
    }
  }
  public function my_profile() {
    $user = auth()->user();
    return view('user.profile', compact('user'));
  }
  public function change_pass(Request $req) {
    $user = auth()->user();
    $user_n = User::find($user->id);
    if (password_verify($req->pass, $user_n->password)) {
      $user_n->password = bcrypt($req->new);
      if ($user_n->save()) {
        return response()->json(['success' => true, 'message' => 'Contraseña actualizada con exito']);
      } else {
        return response()->json(['success' => false, 'message' => 'Ocurrio error desconocido']);
      }
    } else {
      return response()->json(['success' => false, 'message' => 'Contraseña anterior incorrecta']);
    }
  }
}
