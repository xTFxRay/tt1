<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    /**
     * Show the music upload form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('music.create');
    }

    /**
     * Store the uploaded music file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:mp3,wav',
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $music = new Music();
        $music->title = $request->input('title');
        $music->artist = $request->input('artist');
        $music->file_path = $filePath;
        $music->save();

        return redirect()->route('music.index')->with('success', 'Music uploaded successfully.');
    }
}
