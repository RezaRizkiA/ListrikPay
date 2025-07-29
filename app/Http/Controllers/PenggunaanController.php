<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{
    public function index()
    {
        $penggunaans = Penggunaan::all();
        return view('dashboard.penggunaan', compact('penggunaans'));
    }
}
