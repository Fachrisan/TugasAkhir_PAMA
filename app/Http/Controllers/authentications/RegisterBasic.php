<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RegisterBasic extends Controller
{
  public function index(): View
  {
    return view('content.login.register');
  }

  public function reg(Request $request): RedirectResponse
  {
    $request->validate([
      'username' => ['required'],
      'password' => ['required'],
      'level' => ['required', 'in:admin,dosen,mahasiswa'], // Tambahkan validasi level
    ]);

    $user = Login::create([
      'username' => $request->username,
      'password' => Hash::make($request->password),
      'level' => $request->level ?? 'mahasiswa', // Default level kasir
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect('/'); // Return ke route /tampil untuk semua level user
  }
}
