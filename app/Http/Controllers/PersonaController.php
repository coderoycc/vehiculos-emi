<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonaController extends Controller {
  public function index() {
    return view('personal.index');
  }


  public function loginPublic(Request $request) {
    $credentials = $request->only('usuario', 'password');
    $persona = Persona::where('usuario', $credentials['usuario'])->first();
    if ($persona && Hash::check($credentials['password'], $persona->password)) {
      session()->put('persona', json_encode($persona));
      return redirect()->route('home_public');
    } else {
      return redirect("/login")->withErrors('Credenciales incorrectas');
    }
  }
  public function logout(Request $request) {
    session()->forget('persona');
    session()->regenerate(true);
    return redirect()->route('login_public');
  }

  public function create(Request $request) {
    $persona = new Persona();
    $persona->nombre = $request->nombre;
    $persona->ci = $request->ci;
    $persona->usuario = $request->ci;
    $persona->password = bcrypt($request->ci);
    $persona->celular = $request->celular ?? '0';
    $persona->cargo = $request->cargo;
    if ($persona->save()) {
      return response()->json(['mensaje' => 'Guardado con éxito'], 200);
    } else {
      return response()->json(['mensaje' => 'Error al guardar'], 500);
    }
  }
  public function list() {
    $personas = Persona::all();
    return response()->json(["personas" => $personas, 'status' => true], 200);
  }
}
