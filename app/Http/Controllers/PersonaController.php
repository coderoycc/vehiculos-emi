<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller {
  public function index() {
    return view('personal.index');
  }
  public function create(Request $request) {
    // $data = $request->all();
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
