<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $pelanggans = Pelanggan::with(['user', 'tarif', 'tagihans', 'penggunaan'])->get();
        return view('dashboard.pelanggan', compact('pelanggans', 'users'));
    }

}
