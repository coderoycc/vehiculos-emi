<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model implements Authenticatable {
  use HasFactory;
  protected $fillable = ['nombre', 'ci', 'usuario', 'password', 'celular', 'cargo'];
  public $timestamps = false;
  function getAuthIdentifier() {
  }
  function getAuthIdentifierName() {
  }
  function getAuthPassword() {
  }
  function getRememberToken() {
  }
  function getRememberTokenName() {
  }
  function setRememberToken($value) {
  }
  public function vehiculos() {
    return $this->hasMany(Vehiculo::class);
  }
}
