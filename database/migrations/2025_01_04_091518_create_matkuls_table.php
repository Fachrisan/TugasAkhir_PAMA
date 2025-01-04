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
    Schema::create('matkuls', function (Blueprint $table) {
      $table->string('id_matkul')->primary(); // VARCHAR sebagai primary key tanpa auto-increment
      $table->string('nama');
      $table->integer('sks');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('matkuls');
  }
};
