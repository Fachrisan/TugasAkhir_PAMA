<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita; // Pastikan model Berita diimport
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;

class Analytics extends Controller
{
  public function index()
  {
    // Ambil data berita dari database, bisa ditambah pagination jika diperlukan
    $beritas = Berita::orderBy('tanggal', 'desc')->get();
    $dosen = Dosen::all();
    $mahasiswa = Mahasiswa::all();
    $matkuls = Matkul::all();

    // Kirim data ke view
    return view('content.dashboard.dashboards-analytics', compact('beritas', 'dosen', 'mahasiswa', 'matkuls'));
  }
}
