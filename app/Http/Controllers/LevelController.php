<?php
namespace App\Http\Controllers;

use App\Models\Level;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('dashboard.level', compact('levels'));
    }
}
