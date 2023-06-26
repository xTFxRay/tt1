<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'song_id',
    ];

    /**
     * Get the user associated with the cart.
     */
    // Cart model
public function song()
{
    return $this->belongsTo(Song::class);
}

// Song model
public function cartItems()
{
    return $this->hasMany(Cart::class);
}

}

