<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
  use HasFactory;

  protected $table = 'beritas'; // Sesuai dengan nama tabel
  protected $primaryKey = 'id_berita'; // Sesuai dengan kolom primary key
  public $timestamps = false; // Matikan timestamps jika tidak ada kolom created_at dan updated_at

  protected $fillable = ['judul', 'berita', 'tanggal'];
}
