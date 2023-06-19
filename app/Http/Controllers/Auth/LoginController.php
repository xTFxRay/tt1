<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite; // Import the correct namespace
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // If the user exists, log them in
            Auth::login($existingUser);
        } else {
            // If the user doesn't exist, create a new user and log them in
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->save();

            Auth::login($newUser);
        }

        return redirect('/home');
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
