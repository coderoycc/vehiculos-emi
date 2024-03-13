<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller {
  public function index($page) {
    $vista = view('pages.' . $page)->render();
    return response()->json(['html' => $vista], 200, [], JSON_UNESCAPED_UNICODE);
  }
}
