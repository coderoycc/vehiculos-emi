<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model {
  use HasFactory;
  protected $fillable = ['fechaHora', 'tipo', 'vehiculo_id', 'usuario_id'];
  protected $table = 'registros';
  public $timestamps = false;

  public function vehiculo() {
    return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
  }
}
