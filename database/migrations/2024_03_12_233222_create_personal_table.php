<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('personas', function (Blueprint $table) {
      $table->id();
      $table->string('nombre');
      $table->string('ci', 30)->unique();
      $table->string('usuario', 30)->unique()->comment('por defecto CI');
      $table->string('password');
      $table->string('celular', 30)->nullable();
      $table->string('cargo', 50)->nullable()->comment('Area donde trabaja');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('personas');
  }
};
