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
    Schema::create('mahasiswa1', function (Blueprint $table) {
      $table->id('id_mahasiswa');
      $table->unsignedBigInteger('id_user');
      $table->string('nim');
      $table->string('nama');
      $table->text('alamat');
      $table->string('telpon');
      $table->string('email');
      $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
      $table->date('tanggal_lahir');
      $table->integer('semester');
      $table->string('tahun_ajaran');
      $table->string('jurusan');
      $table->enum('status', ['aktif', 'tidakaktif'])->default('aktif');
      $table->string('foto')->nullable();
      $table->timestamps();

      // Definisi foreign key yang benar
      $table
        ->foreign('id_user')
        ->references('id_user')
        ->on('login')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('mahasiswa1');
  }
};
