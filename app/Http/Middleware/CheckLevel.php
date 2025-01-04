<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
  public function handle(Request $request, Closure $next, $level)
  {
    // Periksa apakah pengguna sudah login
    if (!Auth::check()) {
      return redirect('/'); // Redirect jika tidak login
    }

    // Periksa level pengguna
    if (Auth::user()->level !== $level) {
      return redirect('/');
    }

    return $next($request);
  }
}
