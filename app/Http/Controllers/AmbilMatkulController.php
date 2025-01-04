<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmbilMatkulController extends Controller
{
  public function index()
  {
    return view('content.ambilmatkul.index');
  }
}
