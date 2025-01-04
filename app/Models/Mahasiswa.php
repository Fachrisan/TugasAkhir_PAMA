<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
  protected $table = 'mahasiswa1';
  protected $primaryKey = 'id_mahasiswa';

  protected $fillable = [
    'id_user',
    'nim',
    'nama',
    'alamat',
    'telpon',
    'email',
    'jenis_kelamin',
    'tanggal_lahir',
    'semester',
    'tahun_ajaran',
    'jurusan',
    'status',
    'foto',
  ];

  public function login()
  {
    return $this->belongsTo(Login::class, 'id_user', 'id_user');
  }
}
