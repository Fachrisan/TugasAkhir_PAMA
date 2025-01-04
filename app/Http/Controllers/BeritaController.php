<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
  public function index()
  {
    $beritas = Berita::all();
    return view('content.berita.index', compact('beritas'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'judul' => 'required',
      'berita' => 'required',
      'tanggal' => 'required|date',
    ]);

    Berita::create($request->all());

    return redirect()
      ->route('berita.index')
      ->with('success', 'Berita berhasil ditambahkan');
  }

  public function update(Request $request, Berita $berita)
  {
    $request->validate([
      'judul' => 'required',
      'berita' => 'required',
      'tanggal' => 'required|date',
    ]);

    $berita->update($request->all());

    return redirect()
      ->route('berita.index')
      ->with('success', 'Berita berhasil diperbarui');
  }

  public function destroy(Berita $berita)
  {
    $berita->delete();
    return redirect()
      ->route('berita.index')
      ->with('success', 'Berita berhasil dihapus');
  }
}
