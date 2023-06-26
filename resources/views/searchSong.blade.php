@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                    @if ($songs->isEmpty())
                        <h2>{{ trans(App::getLocale() . '.no_songs_matching_keywords') }}</h2>
                    @else
                        @foreach($songs as $song)
                            <div>
                                <h3>{{ $song->title }}</h3>
                                <p>{{ trans(App::getLocale() . '.artist') }}: {{ $song->user->name }}</p>
                                <!-- Display other song details as needed -->
                            </div>
                        @endforeach
                    @endif                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
