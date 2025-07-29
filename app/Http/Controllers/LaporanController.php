<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // $penggunaans = Laporan::all();
        return view('dashboard.laporan');
    }
}
