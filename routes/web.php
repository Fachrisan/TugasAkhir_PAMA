<?php

use App\Http\Controllers\AmbilMatkulController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\NilaiController;

use function Symfony\Component\String\b;

// // Main Page Route
// Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
//login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/lgn', [LoginController::class, 'index']);
Route::post('/proses-login', [LoginController::class, 'login_proses'])->name('proses-login');
Route::get('/register', [RegisterBasic::class, 'index'])->name('register');
Route::get('/registerm', [RegisterBasic::class, 'indexm'])->name('registerm');
Route::post('/proses-reg', [RegisterBasic::class, 'reg'])->name('proses-reg');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  //dashboard
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
});
Route::middleware(['auth', 'checklevel:admin,mahasiswa,dosen'])->group(function () {
  //datauser
  Route::get('/datauser', [DataUserController::class, 'index'])->name('datauser.index');
  Route::get('/user', [LoginController::class, 'user'])->name('user.index');
  Route::post('/user-store', [LoginController::class, 'store'])->name('user.store');
  Route::get('/user/{id_user}/edit', [LoginController::class, 'edit'])->name('user.edit');
  Route::put('/user/{id_user}', [LoginController::class, 'update'])->name('user.update');
  Route::delete('/user/{id_user}', [LoginController::class, 'destroy'])->name('user.destroy');

  //dosen
  // Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
  Route::resource('dosen', DosenController::class);
  Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
  Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');

  //Mahasiswa
  // Route::get('/profil', [MahasiswaController::class, 'profil'])->name('profil.index');
  Route::resource('mahasiswa', MahasiswaController::class);
  Route::get('profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
  //matkul
  Route::resource('matkul', MatkulController::class);

  //jadwal
  // Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
  Route::resource('jadwal', JadwalController::class);

  //nilai
  Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');

  //ambilmatkul
  // Route::get('/ambilmatkul', [AmbilMatkulController::class, 'index'])->name('ambilmatkul.index');
  Route::resource('ambilmatkul', AmbilMatkulController::class);

  //berita
  Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
  Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
  Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
  Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
  Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
  Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

  Route::resource('mahasiswa', MahasiswaController::class);
});
