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
    $vehiculo->hash = hash('sha256', $request->placa);
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

  public function getByHash($hash) {
    try {
      $vehiculo = \App\Models\Vehiculo::where('hash', $hash)
        ->select('id', 'placa', 'tipo', 'color', 'habilitado', 'detalle', 'persona_id')
        ->with(['persona'])
        ->first();
      if ($vehiculo == null)
        return response()->json(['data' => null, 'status' => false, 'message' => 'Vehículo no encontrado']);
      else
        return response()->json(['data' => $vehiculo, 'status' => true]);
    } catch (\Throwable $th) {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Error al obtener el vehículo.']);
    }
  }

  public function index() {
    $personal = \App\Models\Persona::all();
    return view('vehiculo.index', ['personal' => $personal]);
  }
}
