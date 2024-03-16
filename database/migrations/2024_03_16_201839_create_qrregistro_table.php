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
    Schema::create('qrregistro', function (Blueprint $table) {
      $table->id();
      $table->dateTime('fechaGenerado')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->dateTime('fechaVencimiento')->nullable();
      $table->string('tipo', 20)->comment('INGRESO | SALIDA');
      $table->integer('usado')->default(0)->comment('0 = NO, 1 = SI');
      $table->string('codigoQR', 64)->unique()->comment('HASH de fechas, tipo y persona_id vehiculo_id');

      $table->foreignId('persona_id')->constrained('personas'); //Propietario
      $table->foreignId('vehiculo_id')->constrained('vehiculos');
      $table->foreignId('usuario_id')->nullable()->constrained('usuario'); // usuario que registro ingreso o salida

    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('qrregistro');
  }
};
