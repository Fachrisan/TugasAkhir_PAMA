<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
  use HasFactory;

  protected $table = 'matkuls'; // Nama tabel
  protected $primaryKey = 'id_matkul'; // Primary key
  public $incrementing = false; // Non-auto increment
  protected $keyType = 'string'; // Tipe varchar untuk primary key

  protected $fillable = ['id_matkul', 'nama', 'sks']; // Kolom yang dapat diisi
}
