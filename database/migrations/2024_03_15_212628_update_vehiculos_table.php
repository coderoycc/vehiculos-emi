<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('vehiculos', function (Blueprint $table) {
      $table->string('hash', 64)->nullable()->after('id');
      $table->string('habilitado', 2)->default('SI')->after('placa')->comment('SI | NO');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('vehiculos', function (Blueprint $table) {
      $table->dropColumn('hash');
      $table->dropColumn('habilitado');
    });
  }
};
