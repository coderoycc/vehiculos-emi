<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class RegistroController extends Controller {
  public function create(Request $request) {
    $hash = $request->hash;
    $vehiculo = Vehiculo::where('hash', $hash)->first();
    if ($vehiculo) {
      $registro = new Registro();
      $registro->vehiculo_id = $vehiculo->id;
      $registro->tipo = $request->tipo;
      $fechaHora = date('Y-m-d H:i:s');
      $registro->fechaHora = $fechaHora;
      $registro->usuario_id = $request->idUsuario;
      if ($registro->save()) {
        return response()->json(['status' => true, 'message' => 'Registro creado'], 200);
      } else {
        return response()->json(['status' => false, 'message' => 'Error al crear el registro'], 500);
      }
    } else {
      return response()->json(['status' => false, 'message' => 'Vehiculo no encontrado'], 404);
    }
  }
}
