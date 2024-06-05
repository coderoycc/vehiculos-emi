<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table(
      'vehiculos',
      function (Blueprint $table) {
        $table->json('docs')->nullable()->comment('JSON con nombres de los documentos del vehiculo');
      }
    );
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('vehiculos', function (Blueprint $table) {
      $table->dropColumn('fechaRegistro');
    });
  }
};
