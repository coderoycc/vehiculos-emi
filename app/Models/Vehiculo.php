<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model {
  use HasFactory;
  protected $fillable = ['placa', 'anio', 'color', 'detalle', 'tipo', 'modelo', 'hash', 'persona_id', 'usuario_id', 'docs'];


  public function persona() {
    return $this->belongsTo(Persona::class);
  }
  public function creado_por() {
    return $this->belongsTo(User::class, 'usuario_id');
  }
}
