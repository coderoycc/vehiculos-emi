<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

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
  public function registrar(Request $request) {
    $qr = null;
    if (isset($request->hash) && isset($request->id) && isset($request->idUsuario)) {
      $qr = \App\Models\Qrregistro::where('codigoQR', $request->hash)->where('id', $request->id)->first();
    } else if (isset($request->hash) && isset($request->idUsuario)) {
      $qr = \App\Models\Qrregistro::where('codigoQR', $request->hash)->first();
    } else if (isset($request->id) && $request->idUsuario) {
      $qr = \App\Models\Qrregistro::where('id', $request->id)->first();
    } else {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Parámetros faltantes'], 403);
    }
    if ($qr) {
      $qr->usado = 1;
      $qr->fechaRegistro = date('Y-m-d H:i:s');
      $qr->usuario_id = $request->idUsuario;
      if ($qr->save()) return response()->json(['data' => $qr, 'status' => true, 'message' => 'Registrado con éxito'], 200);
      else return response()->json(['data' => null, 'status' => false, 'message' => 'Ocurrió un error al registrar'], 500);
    } else {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Registro no encontrado'], 404);
    }
  }
  public function create(Request $request) {
    $qr = new \App\Models\Qrregistro();
    $persona = json_decode(session()->get('persona'));
    $qr->tipo = $request->tipo;
    $qr->fechaVencimiento = date('Y-m-d H:i:s', strtotime('+30 min'));
    $qr->persona_id = $persona->id;
    $qr->vehiculo_id = intval($request->idVehiculo);
    $qr->codigoQR = hash('sha256', $qr->fechaVencimiento . $qr->tipo . $qr->persona_id . $qr->vehiculo_id);
    if ($qr->save()) {
      return response()->json(['data' => $qr, 'status' => true, 'message' => 'QR creado con éxito'], 200);
    } else {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Ocurrió un error al crear el QR'], 500);
    }
  }
  public function generarqr($id) {
    try {
      $qr = \App\Models\Qrregistro::where('id', $id)->first();
      if ($qr) {
        $renderer = new ImageRenderer(new RendererStyle(400,3),new SvgImageBackEnd());
        $writer = new Writer($renderer);
        $cad = $writer->writeString($qr->codigoQR, 'utf-8');
        return response()->json(['status' => true, 'message' => 'Codigo QR generado', 'data' => $cad], 200);
      } else {
        return response()->json(['status' => false, 'message' => 'Registro no encontrado', 'data' => null], 404);
      }
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message'=>$e->getMessage()], 500);
    }
  }
}
