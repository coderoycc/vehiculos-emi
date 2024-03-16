<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrregistroController extends Controller {
  public function verificarqr($hash) {
    try {
      $qr = \App\Models\Qrregistro::where('codigoQR', $hash)
        ->select('id', 'fechaVencimiento', 'tipo', 'persona_id', 'vehiculo_id', 'usado')
        ->with(['propietario'])
        ->with(['vehiculo'])
        ->first();
      if ($qr == null)
        return response()->json(['data' => null, 'status' => false, 'message' => 'Vehículo no encontrado'], 400);
      else
        return response()->json(['data' => $qr, 'status' => true], 200);
    } catch (\Throwable $th) {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Error al obtener el vehículo.'], 500);
    }
  }
}
