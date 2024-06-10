<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  public function index() {
    if (Auth::check()) {
      return redirect()->intended('/panel');
    }
    return view('auth.login');
  }
  public function login(Request $request) {
    $request->validate(['usuario' => 'required', 'password' => 'required']);
    $credentials = $request->only('usuario', 'password');
    if (Auth::attempt($credentials)) {
      return redirect()->intended('/panel/reports')->withSuccess('Login exitosos');
    }
    return redirect("/panel/login")->withErrors('Credenciales incorrectas');
  }

  public function loggedin() {
    if (Auth::check()) {
      return view('home');
    }
    return redirect("login")->withErrors('Debes iniciar sesión');
  }
  public function logout(Request $request) {
    Auth::logout();
    return redirect("/panel/login")->withSuccess('Logout exitoso');
  }
}
