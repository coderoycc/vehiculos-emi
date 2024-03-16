<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller { // pagina publica
  public function index() {
    return view('auth.login_public');
  }
}
