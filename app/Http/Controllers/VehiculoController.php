<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Qrregistro;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Barryvdh\DomPDF\Facade\Pdf as PDF;

class VehiculoController extends Controller {

  public function create(Request $request) {
    $idUsuario = Auth::user()->id;
    $vehiculo = new Vehiculo();
    $vehiculo->placa = $request->placa;
    $vehiculo->modelo = $request->modelGo;
    $vehiculo->color = $request->color;
    $vehiculo->tipo = $request->tipo;
    $vehiculo->usuario_id = $idUsuario;
    $vehiculo->persona_id = $request->idPersona;
    $vehiculo->detalle = $request->detalle;
    $vehiculo->anio = 0;

    $docs_names = $this->save_documents($request);
    $vehiculo->docs = json_encode($docs_names);


    if ($vehiculo->save()) {
      return redirect('/panel/personal/vehiculo?id='.$request->idPersona)->with('success_create', 'Registro guardado exitosamente.');
    } else {
      return redirect()->back()->with('error_create', 'Ha ocurrido un error al guardar el registro.');
    }
  }

  public function list() {
    $vehiculos = Vehiculo::with(['persona', 'creado_por'])->get();
    return response()->json(['data' => $vehiculos, 'status' => true]);
  }

  public function getByHash($hash) {
    try {
      $vehiculo = Vehiculo::where('hash', $hash)
        ->select('id', 'placa', 'tipo', 'color', 'habilitado', 'detalle', 'persona_id')
        ->with(['persona'])
        ->first();
      if ($vehiculo == null)
        return response()->json(['data' => null, 'status' => false, 'message' => 'Vehículo no encontrado'], 404);
      else
        return response()->json(['data' => $vehiculo, 'status' => true], 200);
    } catch (\Throwable $th) {
      return response()->json(['data' => null, 'status' => false, 'message' => 'Error al obtener el vehículo.'], 500);
    }
  }

  public function index(Request $req) {
    $propietario = Persona::find($req->id);
    return view('vehiculo.index', ['persona' => $propietario]);
  }
  public function edit_modal($id) {
    $vehiculo = Vehiculo::find($id);
    $vehiculo->persona = Persona::find($vehiculo->persona_id);
    $view = view('vehiculo.edit_content', ['vehiculo' => $vehiculo])->render();
    return response()->json(['data' => $view, 'status' => true]);
  }
  public function update(Request $data) {
    $vehiculo = Vehiculo::find($data->vehiculo_id);
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
    $vehiculo = Vehiculo::find($data->id);
    $vehiculo->habilitado = $data->value == "SI" ? "NO" : "SI";
    if ($vehiculo->save()) {
      return response()->json(['status' => true, 'message' => 'Vehiculo actualizado exitosamente'], 200);
    } else {
      return response()->json(['status' => false, 'message' => 'Error al actualizar el vehiculo'], 500);
    }
  }
  public function reports(Request $data) {
    $cantidades = Qrregistro::cantidades_hoy();
    return view('vehiculo.reports', ['cantidades' => $cantidades]);
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
  public function report(Request $req) {
    $start = $req->start ?? date('Y-m') . '-01';
    $end = $req->end ?? date('Y-m-d');
    $vehiculosIn = Qrregistro::where('usado', 1)->whereBetween('fechaGenerado', [$start, $end])->where('tipo', 'INGRESO')->with('propietario')->with('vehiculo')->get();
    $vehiculosOut = Qrregistro::where('usado', 1)->whereBetween('fechaGenerado', [$start, $end])->where('tipo', 'SALIDA')->with('propietario')->with('vehiculo')->get();
    $pdf = PDF::loadView('reports.main_report', ['vehiculosIn' => $vehiculosIn, 'vehiculosOut' => $vehiculosOut, 'start' => $start, 'end' => $end]);
    return $pdf->stream();
  }

  public function save_documents(Request $request): array {
    $arr_save = [];
    $arr_names = ['doc', 'ci', 'lice', 'ruat', 'soat', 'insp', 'img'];
    foreach ($arr_names as $cad_name) {
      $document = $request->file($cad_name);
      if ($document != null) {
        $name = $cad_name . '_' . date('dmyHis') . '.' . $document->extension();
        $rr = $document->storeAs('public/vehiculos', $name);
        if ($rr)
          $arr_save[$cad_name] = $name;
      }
    }
    return $arr_save;
  }
  public function docs_content(Request $req) {
    $vehiculo = Vehiculo::find($req->id);
    $nombres = ['doc' => 'DOCUMENTACION', 'ci' => "CARNET", 'lice' => "LICENCIA", 'ruat' => "RUAT", 'soat' => "SOAT", 'insp' => "INSP. VEHICULAR", 'img' => "IMAGEN"];
    $cad_docs = $vehiculo->docs ?? '[]';
    $docs_list = json_decode($cad_docs, true);
    $colors = ['#97dc0c', '#26e0a0', '#9e38ee', '#38ee50', '#50e0ee', '#e4dc66', '#3f51b5'];
    $view = view('vehiculo.modal_docs_content', ['docs' => $docs_list, 'colors' => $colors, 'nombres' => $nombres])->render();
    return response()->json(['html' => $view, 'status' => true]);
  }
}
