<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
  public function index()
  {
    $jadwals = Jadwal::with(['matkul', 'dosen'])->get();
    $matkuls = Matkul::all();
    $dosens = Dosen::all();

    return view('content.jadwal.index', compact('jadwals', 'matkuls', 'dosens'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'id_matkul' => 'required|exists:matkuls,id_matkul',
      'id_dosen' => 'required|exists:dosen,id_dosen',
      'hari' => 'required|string',
      'jam' => 'required|string',
      'ruangan' => 'required|string',
    ]);

    Jadwal::create($request->all());

    return redirect()
      ->route('jadwal.index')
      ->with('success', 'Jadwal berhasil ditambahkan');
  }

  public function show($id)
  {
    $jadwal = Jadwal::with(['matkul', 'dosen'])->findOrFail($id);

    return response()->json([
      'status' => 'success',
      'data' => [
        'id_jadwal' => $jadwal->id_jadwal,
        'id_matkul' => $jadwal->id_matkul,
        'nama_matkul' => $jadwal->matkul->nama,
        'sks' => $jadwal->matkul->sks,
        'id_dosen' => $jadwal->id_dosen,
        'nama_dosen' => $jadwal->dosen->nama,
        'hari' => $jadwal->hari,
        'jam' => $jadwal->jam,
        'ruangan' => $jadwal->ruangan,
      ],
    ]);
  }

  public function update(Request $request, $id)
  {
    $jadwal = Jadwal::findOrFail($id);

    $request->validate([
      'id_matkul' => 'required|exists:matkuls,id_matkul',
      'id_dosen' => 'required|exists:dosen,id_dosen',
      'hari' => 'required|string',
      'jam' => 'required|string',
      'ruangan' => 'required|string',
    ]);

    $jadwal->update($request->all());

    return redirect()
      ->route('jadwal.index')
      ->with('success', 'Jadwal berhasil diperbarui');
  }

  public function destroy($id)
  {
    $jadwal = Jadwal::findOrFail($id);
    $jadwal->delete();

    return redirect()
      ->route('jadwal.index')
      ->with('success', 'Jadwal berhasil dihapus');
  }
}
