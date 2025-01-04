<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
  public function run()
  {
    // Buat user Admin
    Login::create([
      'username' => 'admin',
      'password' => Hash::make('admin'),
      'level' => 'admin',
    ]);

    // // Buat user Dosen
    // Login::create([
    //     'nama' => 'Dosen Satu',
    //     'username' => 'dosen1',
    //     'password' => Hash::make('dosen123'),
    //     'level' => 'dosen'
    // ]);

    // // Buat user Mahasiswa
    // Login::create([
    //     'nama' => 'Mahasiswa Satu',
    //     'username' => 'mhs1',
    //     'password' => Hash::make('mhs123'),
    //     'level' => 'mahasiswa'
    // ]);
  }
}
