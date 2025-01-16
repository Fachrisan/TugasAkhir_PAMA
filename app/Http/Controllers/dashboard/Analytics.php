<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita; // Pastikan model Berita diimport

class Analytics extends Controller
{
  public function index()
  {
    // Ambil data berita dari database, bisa ditambah pagination jika diperlukan
    $beritas = Berita::orderBy('tanggal', 'desc')->get();

    // Kirim data berita ke view
    return view('content.dashboard.dashboards-analytics', compact('beritas'));
  }
}
