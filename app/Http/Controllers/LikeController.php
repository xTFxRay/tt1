<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class LikeController extends Controller
{
    public function addLike(Request $request)
    {
        $songId = $request->input('song_id');
    
        // Get the song by ID
        $song = Song::findOrFail($songId);
    
        // Increment the like count
        $song->increment('Likes');
    
        // Redirect the user or return a response
        return redirect()->back()->with('success', 'Song liked successfully!');
    }
    
}
