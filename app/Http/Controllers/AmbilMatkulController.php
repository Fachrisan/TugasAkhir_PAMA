<?php

namespace App\Http\Controllers;

use App\Models\AmbilMatkul;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AmbilMatkulController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $user = Auth::user();

    if ($user->level === 'mahasiswa') {
      $ambilmatkul = AmbilMatkul::with('matkul')
        ->where('id_user', $user->id_user)
        ->get();
    } else {
      $ambilmatkul = AmbilMatkul::with(['matkul', 'login'])->get();
    }

    $matkul = Matkul::all(); // 🔥 Tambahkan ini untuk memastikan variabel $matkul dikirim ke view

    return view('content.ambilmatkul.index', compact('ambilmatkul', 'matkul'));
  }

  public function create()
  {
    if (Auth::user()->level === 'mahasiswa') {
      $matkuls = Matkul::all(); // Ganti $matkul menjadi $matkuls
      return view('ambilmatkul.create', compact('matkuls'));
    }

    return redirect()
      ->route('ambilmatkul.index')
      ->with('error', 'Hanya mahasiswa yang dapat mengambil mata kuliah');
  }

  public function store(Request $request)
  {
    $request->validate([
      'id_matkul' => 'required|exists:matkuls,id_matkul', // Perhatikan nama tabel
    ]);

    $exists = AmbilMatkul::where('id_user', Auth::user()->id_user)
      ->where('id_matkul', $request->id_matkul)
      ->exists();

    if ($exists) {
      return back()->with('error', 'Anda sudah mengambil mata kuliah ini');
    }

    try {
      DB::beginTransaction();

      $matkul = Matkul::where('id_matkul', $request->id_matkul)->first();

      AmbilMatkul::create([
        'id_user' => Auth::user()->id_user,
        'id_matkul' => $matkul->id_matkul,
        'nama' => $matkul->nama,
        'sks' => $matkul->sks,
      ]);

      DB::commit();
      return redirect()
        ->route('ambilmatkul.index')
        ->with('success', 'Berhasil mengambil mata kuliah');
    } catch (\Exception $e) {
      DB::rollback();
      return back()->with('error', 'Terjadi kesalahan saat mengambil mata kuliah');
    }
  }

  public function edit($id)
  {
    $ambilmatkul = AmbilMatkul::findOrFail($id);

    if (Auth::user()->level === 'mahasiswa' && $ambilmatkul->id_user !== Auth::user()->id_user) {
      return redirect()
        ->route('ambilmatkul.index')
        ->with('error', 'Anda tidak memiliki akses ke data ini');
    }

    $matkuls = Matkul::all(); // Ganti $matkul menjadi $matkuls
    return view('ambilmatkul.edit', compact('ambilmatkul', 'matkuls'));
  }

  public function update(Request $request, $id)
  {
    $ambilmatkul = AmbilMatkul::findOrFail($id);

    if (Auth::user()->level === 'mahasiswa' && $ambilmatkul->id_user !== Auth::user()->id_user) {
      return redirect()
        ->route('ambilmatkul.index')
        ->with('error', 'Anda tidak memiliki akses ke data ini');
    }

    $request->validate([
      'id_matkul' => 'required|exists:matkuls,id_matkul', // Perhatikan nama tabel
    ]);

    try {
      DB::beginTransaction();

      $matkul = Matkul::where('id_matkul', $request->id_matkul)->first();

      $ambilmatkul->update([
        'id_matkul' => $matkul->id_matkul,
        'nama' => $matkul->nama,
        'sks' => $matkul->sks,
      ]);

      DB::commit();
      return redirect()
        ->route('ambilmatkul.index')
        ->with('success', 'Data berhasil diupdate');
    } catch (\Exception $e) {
      DB::rollback();
      return back()->with('error', 'Terjadi kesalahan saat update data');
    }
  }

  public function destroy($id)
  {
    $ambilmatkul = AmbilMatkul::findOrFail($id);

    if (Auth::user()->level === 'mahasiswa' && $ambilmatkul->id_user !== Auth::user()->id_user) {
      return redirect()
        ->route('ambilmatkul.index')
        ->with('error', 'Anda tidak memiliki akses ke data ini');
    }

    try {
      $ambilmatkul->delete();
      return redirect()
        ->route('ambilmatkul.index')
        ->with('success', 'Data berhasil dihapus');
    } catch (\Exception $e) {
      return back()->with('error', 'Terjadi kesalahan saat menghapus data');
    }
  }
}
