<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;




class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $songs = Song::orderBy('created_at', 'desc')->get();
        return view('home', compact('songs'));
    }

    public function uploadProfilePicture(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Get the uploaded file
    $profilePicture = $request->file('profile_picture');

    // Read the contents of the file
    $imageData = file_get_contents($profilePicture->getRealPath());

    // Update the user's profile picture in the database
    Auth::user()->update(['image' => $imageData]);

    // Redirect the user or return a response
    return redirect()->back()->with('success', 'Profile picture uploaded successfully!');
}

    

}
    
