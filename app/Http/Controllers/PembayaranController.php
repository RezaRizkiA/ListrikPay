<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('dashboard.pembayaran', compact('pembayarans'));
    }

    public function pembayaran($pelanggan)
    {
        return view('transaction.pembayaran', compact('pelanggan', $pelanggan));
    }
}
