<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
  public function index()
  {
    $dosen = Dosen::all();
    return view('content.dosen.index', compact('dosen'));
  }
  public function create()
  {
    $available_users = Login::whereNotIn('id_user', Dosen::pluck('id_user')->toArray())->get();

    return response()->json(['available_users' => $available_users]);
  }
  public function store(Request $request)
  {
    $request->validate([
      'id_user' => 'required|exists:login,id_user|unique:dosen',
      'nidn' => 'required|unique:dosen',
      'nama' => 'required',
      'alamat' => 'required',
      'telpon' => 'required',
      'email' => 'required|email|unique:dosen',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required|date',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
      $foto = $request->file('foto');
      $path = $foto->store('public/dosen');
      $data['foto'] = str_replace('public/', '', $path);
    }

    Dosen::create($data);
    return redirect()
      ->route('dosen.index')
      ->with('success', 'Data dosen berhasil ditambahkan');
  }
  public function edit($id)
  {
    $dosen = Dosen::findOrFail($id);
    return view('dosen.edit', compact('dosen'));
  }

  public function update(Request $request, $id)
  {
    $dosen = Dosen::findOrFail($id);

    $request->validate([
      'nidn' => 'required|unique:dosen,nidn,' . $id . ',id_dosen',
      'nama' => 'required',
      'alamat' => 'required',
      'telpon' => 'required',
      'email' => 'required|email|unique:dosen,email,' . $id . ',id_dosen',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required|date',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
      // Hapus foto lama
      if ($dosen->foto) {
        Storage::delete('public/' . $dosen->foto);
      }

      $foto = $request->file('foto');
      $path = $foto->store('public/dosej');
      $data['foto'] = str_replace('public/', '', $path);
    }

    $dosen->update($data);
    return redirect()
      ->route('dosen.index')
      ->with('success', 'Data dosen berhasil diperbarui');
  }

  public function destroy($id)
  {
    $dosen = Dosen::findOrFail($id);

    if ($dosen->foto) {
      Storage::delete('public/' . $dosen->foto);
    }

    $dosen->delete();
    return redirect()
      ->route('dosen.index')
      ->with('success', 'Data dosen berhasil dihapus');
  }
}
