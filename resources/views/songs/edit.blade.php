@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ trans(App::getLocale() . '.edit_song') }}</h1>
        <form action="{{ route('songs.update', ['song' => $song->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">{{ trans(App::getLocale() . '.song_name') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $song->title }}" required>
            </div>
            <button type="submit" class="btn btn-secondary">{{ trans(App::getLocale() . '.update') }}</button>
        </form>
    </div>
@endsection
