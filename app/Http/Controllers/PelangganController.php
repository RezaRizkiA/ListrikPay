<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with(['user', 'tarif', 'tagihans', 'penggunaan'])->get();
        // dd($pelanggans);
        return view('dashboard.pelanggan', compact('pelanggans'));
    }

}
