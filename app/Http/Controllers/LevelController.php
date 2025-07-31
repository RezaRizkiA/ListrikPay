<?php
namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $levels = Level::all();
        return view('dashboard.level', compact('levels', 'users'));
    }
}
