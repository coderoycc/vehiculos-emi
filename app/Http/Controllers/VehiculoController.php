<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiculoController extends Controller {

  public function create(Request $request) {
    $idUsuario = Auth::user()->id;
    $vehiculo = new \App\Models\Vehiculo();
    $vehiculo->placa = $request->placa;
    $vehiculo->modelo = $request->modelo;
    $vehiculo->color = $request->color;
    $vehiculo->tipo = $request->tipo;
    $vehiculo->usuario_id = $idUsuario;
    $vehiculo->persona_id = $request->idPersona;
    $vehiculo->detalle = $request->detalle;
    $vehiculo->anio = 0;
    if ($vehiculo->save()) {
      return response()->json(['status' => true, 'message' => 'Vehiculo agregado exitosamente'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Error al agregar el vehiculo'], 500);
    }
  }

  public function list() {
    $vehiculos = \App\Models\Vehiculo::with(['persona', 'creado_por'])->get();
    return response()->json(['data' => $vehiculos, 'status' => true]);
  }

  public function index() {
    $personal = \App\Models\Persona::all();

    return view('vehiculo.index', ['personal' => $personal]);
  }
}
