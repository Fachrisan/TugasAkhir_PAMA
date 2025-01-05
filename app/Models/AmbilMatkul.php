<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbilMatkul extends Model
{
  protected $table = 'ambilmatkul'; // pastikan nama tabel benar
  protected $primaryKey = 'id_ambilmatkul';
  protected $fillable = ['id_user', 'id_matkul', 'nama', 'sks'];

  // Relasi ke tabel login
  public function login()
  {
    return $this->belongsTo(Login::class, 'id_user', 'id_user');
  }

  // Relasi ke tabel matkul - perhatikan nama tabel yang benar
  public function matkul()
  {
    return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
  }
}
