<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
  public function index()
  {
    $matkuls = Matkul::all();
    return view('content.matkul.index', compact('matkuls'));
  }

  public function create()
  {
    return view('matkul.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'id_matkul' => 'required|unique:matkuls,id_matkul',
      'nama' => 'required|string|max:255',
      'sks' => 'required|integer|min:1',
    ]);

    Matkul::create($request->all());

    return redirect()
      ->route('matkul.index')
      ->with('success', 'Mata kuliah berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $matkul = Matkul::findOrFail($id);
    return view('matkul.edit', compact('matkul'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required|string|max:255',
      'sks' => 'required|integer|min:1',
    ]);

    $matkul = Matkul::findOrFail($id);
    $matkul->update($request->all());

    return redirect()
      ->route('matkul.index')
      ->with('success', 'Mata kuliah berhasil diperbarui.');
  }

  public function destroy($id)
  {
    Matkul::findOrFail($id)->delete();

    return redirect()
      ->route('matkul.index')
      ->with('success', 'Mata kuliah berhasil dihapus.');
  }
}
