<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class PageController extends Controller { // pagina publica
  public function login() {
    if (session()->has('persona'))
      return redirect()->route('home_public');
    return view('auth.login_public');
  }
  public function index() {
    $persona = json_decode(session()->get('persona'));
    $vehiculos = Vehiculo::where('persona_id', $persona->id)->get();
    // var_dump($vehiculos);
    return view('pages.misvehiculos', ['persona' => $persona, 'vehiculos' => $vehiculos]);
  }
  public function listaMisVehiculos() {
    $persona = json_decode(session()->get('persona'));
    $vehiculos = Vehiculo::where('persona_id', $persona->id)->get();
    return view('pages.misvehiculos', ['persona' => $persona, 'vehiculos' => $vehiculos]);
  }
  public function seguimiento() {
    return view('pages.seguimiento');
  }
}
