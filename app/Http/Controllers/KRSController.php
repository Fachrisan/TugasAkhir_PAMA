<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KRSController extends Controller
{
  public function index()
  {
    return view('content.krs.index');
  }
}
