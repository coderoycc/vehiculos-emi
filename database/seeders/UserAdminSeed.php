<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserAdminSeed extends Seeder {
  public function run(): void {
    User::create([
      'nombre' => 'Administrador del sistema',
      'usuario' => 'admin',
      'password' => bcrypt('admin'),
      'rol' => 'ADMIN',
      'ci' => '0',
    ]);
    User::create([
      'nombre' => 'Gen. Guardia',
      'usuario' => 'guardia',
      'password' => bcrypt('guardia'),
      'rol' => 'GUARDIA',
      'ci' => '0',
    ]);
  }
}
