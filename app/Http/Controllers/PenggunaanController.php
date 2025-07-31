<?php
namespace App\Http\Controllers;

use App\Models\Penggunaan;
use Illuminate\Support\Facades\Auth;

class PenggunaanController extends Controller
{
    public function index()
    {
        $users       = Auth::user();
        $penggunaans = Penggunaan::with(['pelanggan', 'tagihan'])->get();
        return view('dashboard.penggunaan', compact('penggunaans', 'users'));
    }
}
