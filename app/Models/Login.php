<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
  protected $table = 'login';
  protected $primaryKey = 'id_user';

  protected $fillable = ['nama', 'username', 'password', 'level'];

  protected $hidden = ['password'];

  // Tambahkan method ini untuk menentukan field username
  public function username()
  {
    return 'username';
  }
}
