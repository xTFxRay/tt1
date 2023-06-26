<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Song;

class CommentController extends Controller
{

    public function index($songId)
    {
    $song = Song::find($songId);
    $comments = Comment::where('song_id', $songId)->get();
    return view('commentsView', compact('comments', 'song'));
    }

    public function destroy($songId)
{
    $song = Song::find($songId);

    // Check if the user has the admin role or is the owner of the song
    if (auth()->user()->role === 'admin' || auth()->user()->id === $song->user_id) {
        $song->delete();
        return redirect()->back()->with('success', 'Song deleted successfully!');
    } else {
        return redirect()->back()->with('error', 'You do not have permission to delete the song.');
    }
}

    




    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'song_id' => 'required|exists:songs,id',
            'comment' => 'required|string|max:255',
        ]);

        // Create a new comment record
        $comment = new Comment();
        $comment->song_id = $validatedData['song_id'];
        $comment->comment = $validatedData['comment'];
        $comment->user_id = Auth::user()->id; // Assuming you have an authenticated user
        $comment->save();

        // Redirect the user back to the song details page or any other desired route
        return redirect()->back()->with('success', 'Comment added successfully!');
    }


}


