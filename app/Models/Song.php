<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'price', 'song_file', 'user_id', 'Likes'];


    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Define the relationship with the Keyword model
    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }
    
    public function songLikes()
    {
        return $this->hasMany(Like::class);
    }
    
    
    public function getLikesAttribute()
    {
        return $this->songLikes()->count();
    }
}





