<?php

namespace App\Http\Controllers;

use App\Models\Qrregistro;
use App\Models\Vehiculo;
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

  public function getByHash($hash) {
    try {
      $vehiculo = \App\Models\Vehiculo::where('hash', $hash)
        ->select('id', 'placa', 'tipo', 'color', 'habilitado', 'detalle', 'persona_id')
        ->with(['persona'])
        ->first();
      if ($vehiculo == null)
        return response()->json(['data' => null, 'status' => false, 'message' => 'Vehículo no encontrado'], 400);
      else
        return response()->json(['data' => $vehiculo, 'status' => true], 200);
    } catch (\Throwable $th) {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Error al obtener el vehículo.'], 500);
    }
  }

  public function index() {
    $personal = \App\Models\Persona::all();
    return view('vehiculo.index', ['personal' => $personal]);
  }
  public function edit_modal($id) {
    $vehiculo = \App\Models\Vehiculo::find($id);
    $vehiculo->persona = \App\Models\Persona::find($vehiculo->persona_id);
    $view = view('vehiculo.edit_content', ['vehiculo' => $vehiculo])->render();
    return response()->json(['data' => $view, 'status' => true]);
  }
  public function update(Request $data) {
    $vehiculo = \App\Models\Vehiculo::find($data->vehiculo_id);
    $vehiculo->placa = $data->placa;
    $vehiculo->color = $data->color;
    $vehiculo->tipo = $data->tipo;
    $vehiculo->detalle = $data->detalle;
    if ($vehiculo->save()) {
      return response()->json(['status' => true, 'message' => 'Vehiculo actualizado exitosamente'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Error al actualizar el vehiculo'], 500);
    }
  }
  public function baja_alta(Request $data) {
    $vehiculo = \App\Models\Vehiculo::find($data->id);
    $vehiculo->habilitado = $data->value == "SI" ? "NO" : "SI";
    if ($vehiculo->save()) {
      return response()->json(['status' => true, 'message' => 'Vehiculo actualizado exitosamente'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Error al actualizar el vehiculo'], 500);
    }
  }
  public function reports(Request $data) {
    return view('vehiculo.reports', []);
  }
  public function report_day(Request $data) {
    $fecha = date('Y-m-d');
    $vehiculosIn = Qrregistro::where('usado', 1)->where('tipo', 'INGRESO')->whereDate('fechaGenerado', $fecha)->with('propietario')->with('vehiculo')->get();
    $vehiculosOut = Qrregistro::where('usado', 1)->where('tipo', 'SALIDA')->whereDate('fechaGenerado', $fecha)->with('propietario')->with('vehiculo')->get();
    return view('reports.vehiculos', ['vehiculosIn' => $vehiculosIn, 'vehiculosOut' => $vehiculosOut]);
  }
  public function report_all(Request $data) {
    $vehiculosIn = Qrregistro::where('usado', 1)->where('tipo', 'INGRESO')->with('propietario')->with('vehiculo')->get();
    $vehiculosOut = Qrregistro::where('usado', 1)->where('tipo', 'SALIDA')->with('propietario')->with('vehiculo')->get();
    return view('reports.vehiculos2', ['vehiculosIn' => $vehiculosIn, 'vehiculosOut' => $vehiculosOut]);
  }
}
