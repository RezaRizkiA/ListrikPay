<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $allUsers = User::all();
        // dd($users);
        return view('dashboard.user', compact('allUsers','users'));
    }
}
