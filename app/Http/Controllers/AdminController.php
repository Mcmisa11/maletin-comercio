<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra el Panel de Control principal
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}