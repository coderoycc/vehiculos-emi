<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller {
  public function create_entry(Request $req) {
    // verificar campos requeridos 'placa' y 'user_id'
    $this->validate($req, [
      'placa' => 'required',
      'user_id' => 'required',
    ]);
    $guest = new Guest([
      'nombre' => $req->nombre ?? '',
      'placa' => $req->placa,
      'detalles' => $req->detalles ?? '',
      'usuario_id' => $req->user_id
    ]);

    if ($guest->save()) {
      return response()->json(['status' => true, 'message' => 'Visitante registrado'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Ocurrio un error al registrar visitante']);
    }
  }
}
