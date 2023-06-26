<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_id',
        'keyword',
    ];

    // Define the relationship with the Song model
    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
