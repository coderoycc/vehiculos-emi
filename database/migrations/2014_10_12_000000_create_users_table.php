<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('usuario', function (Blueprint $table) {
      $table->id();
      $table->string('nombre');
      $table->string('usuario')->unique();
      $table->string('password');
      $table->string('rol')->comment('ADMIN | GUARDIA');
      $table->string('ci')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('users');
  }
};
