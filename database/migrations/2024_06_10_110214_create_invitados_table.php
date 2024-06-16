<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('invitados', function (Blueprint $table) {
      $table->id();
      $table->string('placa', 10)->nullable();
      $table->string('nombre', 120)->nullable();
      $table->string('detalles', 255)->default('');
      $table->integer('estado')->default(1)->comment('1: ingreso, 0: salida');
      $table->dateTime('ingreso_en')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->dateTime('salida_en')->nullable();
      $table->foreignId('usuario_id')->nullable()->constrained('usuario'); // usuario que registro salida
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('invitados');
  }
};
