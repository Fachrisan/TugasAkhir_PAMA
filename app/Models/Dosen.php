<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
  protected $table = 'dosen';
  protected $primaryKey = 'id_dosen';

  protected $fillable = [
    'id_user',
    'nidn',
    'nama',
    'alamat',
    'telpon',
    'email',
    'jenis_kelamin',
    'tanggal_lahir',
    'status',
    'foto',
  ];

  public function login()
  {
    return $this->belongsTo(Login::class, 'id_user', 'id_user');
  }
}
