<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $pembayarans = Pembayaran::all();
        return view('dashboard.pembayaran', compact('pembayarans', 'users'));
    }
}
