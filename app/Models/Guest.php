<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model {
  use HasFactory;
  protected $fillable = ['nombre', 'placa', 'detalles', 'usuario_id'];
  public $table = 'invitados';
  public $timestamps = false;

  public function registered_by(){
    return $this->belongsTo(User::class, 'usuario_id');
  }
}
