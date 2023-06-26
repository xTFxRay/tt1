@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h2 class="song-title">{{ $song->title }}</h2>
                        <p class="song-artist">{{ $song->user->name }}</p>
                      
                        <!-- Audio Player -->
                        <div class="audio-player">
                            <audio controls>
                                <source src="data:audio/mpeg;base64,{{ $songData }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        
                        <p class="song-description">{{ $song->description }}</p>
                        
                        <!-- Like Button -->
                        <form action="{{ route('likes.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                            <button type="submit" class="btn btn-primary">{{ trans(App::getLocale() . '.like') }}</button>
                        </form>
                        
                        <!-- Delete Button -->
                        @auth
                            @if (auth()->user()->role === 'admin' || auth()->user()->id === $song->user_id)
                            <form action="{{ route('songs.destroy', ['song' => $song->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ trans(App::getLocale() . '.delete_song') }}</button>
                            </form>

                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
