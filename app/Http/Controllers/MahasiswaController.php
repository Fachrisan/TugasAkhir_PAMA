<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
  public function index()
  {
    $mahasiswa = Mahasiswa::all();
    return view('content.mahasiswa.index', compact('mahasiswa'));
  }

  public function create()
  {
    // Ambil daftar id_user dari tabel login yang belum terdaftar di mahasiswa
    $available_users = Login::whereNotIn('id_user', Mahasiswa::pluck('id_user')->toArray())->get();

    return response()->json(['available_users' => $available_users]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'id_user' => 'required|exists:login,id_user|unique:mahasiswa1',
      'nim' => 'required|unique:mahasiswa1',
      'nama' => 'required',
      'alamat' => 'required',
      'telpon' => 'required',
      'email' => 'required|email|unique:mahasiswa1',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required|date',
      'semester' => 'required|numeric',
      'tahun_ajaran' => 'required',
      'jurusan' => 'required',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
      $foto = $request->file('foto');
      $path = $foto->store('public/mahasiswa');
      $data['foto'] = str_replace('public/', '', $path);
    }

    Mahasiswa::create($data);
    return redirect()
      ->route('mahasiswa.index')
      ->with('success', 'Data mahasiswa berhasil ditambahkan');
  }

  public function show($id)
  {
    $mahasiswa = Mahasiswa::findOrFail($id);
    return view('content.mahasiswa.profil', compact('mahasiswa'));
  }

  public function edit($id)
  {
    $mahasiswa = Mahasiswa::findOrFail($id);
    return view('mahasiswa.edit', compact('mahasiswa'));
  }

  public function update(Request $request, $id)
  {
    $mahasiswa = Mahasiswa::findOrFail($id);

    $request->validate([
      'nim' => 'required|unique:mahasiswa1,nim,' . $id . ',id_mahasiswa',
      'nama' => 'required',
      'alamat' => 'required',
      'telpon' => 'required',
      'email' => 'required|email|unique:mahasiswa1,email,' . $id . ',id_mahasiswa',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required|date',
      'semester' => 'required|numeric',
      'tahun_ajaran' => 'required',
      'jurusan' => 'required',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
      // Hapus foto lama
      if ($mahasiswa->foto) {
        Storage::delete('public/' . $mahasiswa->foto);
      }

      $foto = $request->file('foto');
      $path = $foto->store('public/mahasiswa');
      $data['foto'] = str_replace('public/', '', $path);
    }

    $mahasiswa->update($data);
    return redirect()
      ->route('mahasiswa.index')
      ->with('success', 'Data mahasiswa berhasil diperbarui');
  }

  public function destroy($id)
  {
    $mahasiswa = Mahasiswa::findOrFail($id);

    if ($mahasiswa->foto) {
      Storage::delete('public/' . $mahasiswa->foto);
    }

    $mahasiswa->delete();
    return redirect()
      ->route('mahasiswa.index')
      ->with('success', 'Data mahasiswa berhasil dihapus');
  }

  public function profile()
  {
    // Mengambil id_user dari session login
    $id_user = Session::get('id_user');

    if (!$id_user) {
      return redirect()
        ->route('login')
        ->with('error', 'Silakan login terlebih dahulu');
    }

    $mahasiswa = Mahasiswa::where('id_user', $id_user)->firstOrFail();
    return view('mahasiswa.profil', compact('mahasiswa'));
  }
}
