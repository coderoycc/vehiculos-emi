<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model {
  use HasFactory;
  protected $fillable = ['nombre', 'ci', 'celular', 'cargo'];
  public $timestamps = false;
  public function vehiculos() {
    return $this->hasMany(Vehiculo::class);
  }
}
