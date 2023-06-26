<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Song;

class WelcomeController extends Controller
{
    public function index()
    {
        $songs = Song::orderBy('created_at', 'desc')->get();

        return view('welcome', compact('songs'));
    }
}

