<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
  use Notifiable;

  protected $fillable = ['id_user', 'username', 'password', 'level'];

  // Ganti autentikasi dari `email` ke `username`
  public function getAuthIdentifierName()
  {
    return 'username';
  }
}
