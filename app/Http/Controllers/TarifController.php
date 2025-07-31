<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $tarifs = Tarif::all();
        return view('dashboard.tarif', compact('tarifs', 'users'));
    }
}
