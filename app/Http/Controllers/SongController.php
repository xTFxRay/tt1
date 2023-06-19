<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Show the form for creating a new song.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created song in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'file' => 'required|mimes:mp3,wav|max:2048',
        ]);

        // Store the uploaded file
        $file = $request->file('file');
        $filePath = $file->store('songs');

        // Create a new song record
        $song = new Song();
        $song->title = $validatedData['title'];
        $song->artist = $validatedData['artist'];
        $song->file_path = $filePath;
        $song->save();

        // Redirect the user to a success page or any other desired route
        return redirect()->route('songs.index')->with('success', 'Song added successfully!');
    }
}
