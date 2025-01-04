<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  mixed  ...$levels
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$levels)
  {
    // Periksa apakah pengguna sudah login
    if (!Auth::check()) {
      return redirect('/'); // Redirect jika tidak login
    }

    // Periksa apakah level pengguna ada dalam daftar level yang diterima
    if (!in_array(Auth::user()->level, $levels)) {
      return redirect('/'); // Redirect jika level tidak sesuai
    }

    return $next($request);
  }
}
