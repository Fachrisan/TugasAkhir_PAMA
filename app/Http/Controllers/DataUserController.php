<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataUserController extends Controller
{
  public function index()
  {
    return view('content.data_user.index');
  }
}
