<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::all();
        $users = Auth::user();
        return view('dashboard.tagihan', compact('tagihans', 'users'));
    }
}
