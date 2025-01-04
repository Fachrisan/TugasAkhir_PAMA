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
    Schema::create('jadwals', function (Blueprint $table) {
      $table->id('id_jadwal');
      $table
        ->foreignId('id_matkul')
        ->constrained('matkuls', 'id_matkul')
        ->onDelete('cascade');
      $table
        ->foreignId('id_dosen')
        ->constrained('dosen', 'id_dosen')
        ->onDelete('cascade');
      $table->string('hari');
      $table->string('jam');
      $table->string('ruangan');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jadawls');
  }
};
