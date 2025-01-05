<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('ambilmatkul', function (Blueprint $table) {
      $table->id('id_ambilmatkul'); // ini tetap auto increment
      $table->foreignId('id_user')->constrained('login', 'id_user');
      $table->string('id_matkul'); // menggunakan string agar tidak auto increment
      $table
        ->foreign('id_matkul')
        ->references('id_matkul')
        ->on('matkuls')
        ->onDelete('cascade');
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
    Schema::dropIfExists('ambilmatkul');
  }
};
