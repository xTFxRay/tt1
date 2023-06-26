@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ trans(App::getLocale() . '.welcome') }}</h1>

        <div class="row">
            @foreach($songs as $song)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $song->title }}</h5>
                            <p class="card-text">{{ trans(App::getLocale() . '.artist') }}: {{ $song->user_id }}</p>
                            <p class="card-text">{{ trans(App::getLocale() . '.likes') }}: {{ $song->Likes }}</p>
                            <a href="{{ route('comments.show', ['song' => $song->id]) }}" class="btn btn-secondary">{{ trans(App::getLocale() . '.view_comments') }}</a>
                            <button class="btn btn-secondary float-end">{{ trans(App::getLocale() . '.add_to_cart') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
