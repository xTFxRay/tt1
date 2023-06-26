<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Song;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve the cart items along with their associated songs
        $cartItems = Cart::with('song')->get();
    
        // Pass the cart items to the view
        return view('cart', ['cartItems' => $cartItems]);
    }
    

    public function addToCart(Request $request)
{
    $songId = $request->route('song_id');
    
    // Retrieve the song details from the database
    $song = Song::find($songId);

    // Check if the song exists in the user's cart
    $existingCart = Cart::where('user_id', $request->user()->id)
        ->where('song_id', $songId)
        ->first();

    if ($existingCart) {
        // Song already exists in the cart, you can handle this case as needed
        return redirect()->route('cart.index')->with('error', 'Song is already in the cart!');
    }

    // Store the song details in the cart
    $cart = new Cart();
    $cart->song_id = $song->id;

    if ($request->user()) {
        $cart->user_id = $request->user()->id;
    }

    $cart->save();

    return redirect()->route('cart.index')->with('success', 'Song added to cart successfully!');
}
public function removeFromCart($cartItemId)
{
    // Find the cart item
    $cartItem = Cart::findOrFail($cartItemId);

    // Delete the cart item
    $cartItem->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully!');
}

}
