<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutHomeController extends Controller
{
    public function index()
    {
        return view('top');
    }
}
