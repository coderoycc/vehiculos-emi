<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('registros', function (Blueprint $table) {
      $table->id();
      $table->dateTime('fechaHora')->comment('Fecha y hora de ingreso o salida');
      $table->string('tipo', 10)->comment('ENTRADA | SALIDA');
      $table->string('observacion', 120)->nullable();
      $table->foreignId('vehiculo_id')->constrained('vehiculos');
      $table->foreignId('usuario_id')->constrained('usuario'); // usuario que registra la entrada o salida
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('registros');
  }
};
