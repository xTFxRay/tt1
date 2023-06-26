<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Models\User;



class SongController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'recent');
        
        // Perform sorting based on the selected option
        if ($sort === 'likes') {
            $songs = Song::orderBy('likes', 'desc')->get();
        } elseif ($sort === 'title') {
            $songs = Song::orderBy('title')->get();
        } else {
            $songs = Song::latest()->get(); // Default sorting by most recent
        }
    
        return view('home', ['songs' => $songs]);
    }
    



public function show($id)
{
    // Retrieve the song from the database
    $song = Song::findOrFail($id);

    // Decode the base64 encoded song file data
    $songData = base64_decode($song->song_file);

    return view('songview', compact('song', 'songData'));
}


    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'user_id' => 'required|int',
            'keyword' => 'required|string',
            'file' => 'required|file',
        ]);
    
        // Get the uploaded file
        $songFile = $request->file('file');
    
        // Read the contents of the file
        $songData = file_get_contents($songFile->getRealPath());
    
        // Encode the file data as base64
        $songData = base64_encode($songData);
    
        // Create a new song record
        $song = new Song();
        $song->title = $validatedData['title'];
        $song->description = $validatedData['description'];
        $song->price = $validatedData['price'];
        $song->user_id = $validatedData['user_id']; // Store the user ID
        $song->song_file = $songData; // Store the encoded file data as a blob
        $song->Likes = 0;
    
        $song->save();
    
        // Create a new keyword record
        $keyword = new Keyword();
        $keyword->song_id = $song->id; // Associate the keyword with the newly created song
        $keyword->keyword = $validatedData['keyword'];
        $keyword->title = $validatedData['title']; // Store the song's title in the keyword record
        $keyword->save();
    
        // Redirect the user to a success page or any other desired route
        return redirect()->route('home')->with('success', 'Song added successfully!');
    }
    
    



    public function search(Request $request)
{
    $keyword = $request->input('search');
    $songs = Song::whereHas('keywords', function ($query) use ($keyword) {
        $query->where('keyword', 'like', '%' . $keyword . '%');
    })->get();
    return view('searchSong', compact('songs'));
}



public function destroy($songId)
{
    $song = Song::find($songId);
    // Check if the user has the admin role or is the owner of the song
    if (auth()->user()->role === 'admin' || auth()->user()->id === $song->user_id) {
        $song->delete();
        $songs = Song::orderBy('created_at', 'desc')->get();
        return view('home', compact('songs'));
    } else {
        return view('home', compact('songs'));
    }
}

    




    
public function edit(Song $song)
{
    return view('songs.edit', compact('song'));
}

public function update(Request $request, Song $song)
{
    $request->validate([
        'title' => 'required|max:255',
    ]);

    $song->title = $request->input('title');
    $song->save();

    return redirect()->route('home', ['song' => $song->id])
        ->with('success', 'Song name updated successfully.');
}




}
