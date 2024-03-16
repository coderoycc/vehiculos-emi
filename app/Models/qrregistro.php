<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrregistro extends Model {
  use HasFactory;

  protected $table = 'qrregistro';

  protected $fillable = ['fechaVencimiento', 'tipo', 'codigoQR', 'persona_id', 'vehiculo_id'];
  public $timestamps = false;

  public function propietario() {
    return $this->belongsTo(Persona::class);
  }
  public function vehiculo() {
    return $this->belongsTo(Vehiculo::class);
  }
}
