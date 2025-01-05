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
      // Mengubah tipe data menjadi string agar sesuai dengan tabel matkuls
      $table->string('id_matkul');
      $table->unsignedBigInteger('id_dosen');
      $table->string('hari');
      $table->string('jam');
      $table->string('ruangan');
      $table->timestamps();

      // Foreign key untuk matkul (menggunakan string)
      $table
        ->foreign('id_matkul')
        ->references('id_matkul')
        ->on('matkuls')
        ->onDelete('cascade');

      // Foreign key untuk dosen
      $table
        ->foreign('id_dosen')
        ->references('id_dosen')
        ->on('dosen')
        ->onDelete('cascade');
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
