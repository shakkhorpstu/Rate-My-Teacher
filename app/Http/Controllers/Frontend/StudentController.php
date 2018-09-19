<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:student');
  }

  public function index()
  {
    return view('frontend.pages.index');
  }
}
