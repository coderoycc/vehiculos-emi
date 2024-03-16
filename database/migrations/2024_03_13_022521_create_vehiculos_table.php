<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('vehiculos', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('placa', 10)->unique();
      $table->integer('anio')->nullable();
      $table->string('hash', 64)->nullable();
      $table->string('habilitado', 2)->default('SI')->comment('SI | NO');
      $table->string('color', 80)->nullable();
      $table->string('detalle', 90)->nullable();
      $table->string('tipo', 30)->comment('MOTO | AUTOMOVIL | CAMION ');
      $table->string('modelo', 50)->nullable();
      $table->foreignId('persona_id')->constrained('personas');
      $table->foreignId('usuario_id')->constrained('usuario'); // usuario que creo el vehiculo
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('vehiculos');
  }
};
