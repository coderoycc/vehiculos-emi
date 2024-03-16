<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller { // pagina panel admin
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index() {
    $personal = \App\Models\Persona::all();
    return view('vehiculo.index', ['personal' => $personal]);
  }
}
