<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrregistro extends Model {
  use HasFactory;

  protected $table = 'qrregistro';

  protected $fillable = ['fechaVencimiento', 'tipo', 'codigoQR', 'persona_id', 'vehiculo_id'];
  public $timestamps = false;

  public static function cantidades_hoy(): array {
    $ingreso = Qrregistro::whereDate('fechaGenerado', '=', date('Y-m-d'))->where('tipo', 'INGRESO')->count();
    $salida = Qrregistro::whereDate('fechaGenerado', '=', date('Y-m-d'))->where('tipo', 'SALIDA')->count();
    return ['ingreso' => $ingreso, 'salida' => $salida];
  }

  public function propietario() {
    return $this->belongsTo(Persona::class, 'persona_id');
  }
  public function vehiculo() {
    return $this->belongsTo(Vehiculo::class);
  }
}
