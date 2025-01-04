<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('login', function (Blueprint $table) {
      $table->id('id_user');
      $table->string('username')->unique();
      $table->string('password');
      $table->enum('level', ['admin', 'dosen', 'mahasiswa']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('login');
  }
};
