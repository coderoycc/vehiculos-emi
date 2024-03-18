<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrregistroController extends Controller {
  public function verificarqr($hash) {
    try {
      $qr = \App\Models\Qrregistro::where('codigoQR', $hash)
        ->select('id', 'fechaVencimiento', 'tipo', 'persona_id', 'vehiculo_id', 'usado', 'codigoQR')
        ->with(['propietario:ci,nombre,id,cargo', 'vehiculo:id,placa,anio,habilitado,color,detalle,tipo'])
        ->first();
      if ($qr == null) {
        return response()->json(['data' => null, 'status' => false, 'message' => 'Vehículo no encontrado'], 404);
      } else {
        $now = date('Y-m-d H:i:s');
        if ($qr->usado) {
          return response()->json(['data' => null, 'status' => false, 'message' => 'El QR ya fue usado'], 400);
        } else if ($qr->fechaVencimiento < $now) {
          return response()->json(['data' => null, 'status' => false, 'message' => 'El QR ha vencido'], 400);
        }
        return response()->json(['data' => $qr, 'status' => true], 200);
      }
    } catch (\Throwable $th) {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Error al obtener el vehículo.'], 500);
    }
  }
}
