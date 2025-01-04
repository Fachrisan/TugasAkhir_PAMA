<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('content.login.index');
  }

  public function login_proses(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      // Redirect berdasarkan level
      switch (Auth::user()->level) {
        case 'admin':
          return redirect('/dashboard');
        case 'dosen':
          return redirect('/dashboard');
        case 'mahasiswa':
          return redirect('/dashboard');
      }
    }

    return redirect()
      ->back()
      ->withErrors(['username' => 'Username atau password salah']);
  }

  public function user()
  {
    // Hanya admin yang bisa akses list user
    if (Auth::user()->level !== 'admin') {
      return redirect()
        ->back()
        ->with('error', 'Anda tidak memiliki akses!');
    }

    $users = Login::all();
    return view('content.data_user.index', compact('users'));
  }

  public function edit($id_user)
  {
    if (Auth::user()->level !== 'admin') {
      return response()->json(['error' => 'Unauthorized'], 403);
    }

    $user = Login::findOrFail($id_user);
    return response()->json($user);
  }

  public function store(Request $request)
  {
    if (Auth::user()->level !== 'admin') {
      return redirect()
        ->back()
        ->with('error', 'Anda tidak memiliki akses!');
    }

    $request->validate([
      'username' => ['required', 'unique:login'],
      'password' => ['required'],
      'level' => ['required', 'in:admin,dosen,mahasiswa'],
    ]);

    $user = Login::create([
      'username' => $request->username,
      'password' => Hash::make($request->password),
      'level' => $request->level,
    ]);

    return redirect()
      ->back()
      ->with('success', 'User berhasil ditambahkan');
  }

  public function update(Request $request, $id_user)
  {
    if (Auth::user()->level !== 'admin') {
      return redirect()
        ->back()
        ->with('error', 'Anda tidak memiliki akses!');
    }

    $request->validate([
      'username' => ['required', 'unique:login,username,' . $id_user . ',id_user'],
      'level' => ['required', 'in:admin,dosen,mahasiswa'],
    ]);

    $user = Login::findOrFail($id_user);
    $user->username = $request->username;
    $user->level = $request->level;

    if ($request->filled('password')) {
      $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()
      ->route('user.index')
      ->with('success', 'User berhasil diperbarui');
  }

  public function destroy($id_user)
  {
    if (Auth::user()->level !== 'admin') {
      return redirect()
        ->back()
        ->with('error', 'Anda tidak memiliki akses!');
    }

    $user = Login::findOrFail($id_user);

    // Mencegah admin menghapus dirinya sendiri
    if ($user->id_user === Auth::id()) {
      return redirect()
        ->back()
        ->with('error', 'Tidak dapat menghapus akun sendiri!');
    }

    $user->delete();

    return redirect()
      ->back()
      ->with('success', 'User berhasil dihapus');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
