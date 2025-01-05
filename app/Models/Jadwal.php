<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
  protected $primaryKey = 'id_jadwal';
  protected $fillable = ['id_matkul', 'id_dosen', 'hari', 'jam', 'ruangan'];

  // Relasi ke tabel matkul
  public function matkul()
  {
    return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
  }

  // Relasi ke tabel dosen
  public function dosen()
  {
    return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
  }
}
