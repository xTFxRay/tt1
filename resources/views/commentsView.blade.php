@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>{{ $song->title }} {{ trans(App::getLocale() . '.comments') }}</h1>
                @foreach($comments as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <p>{{ $comment->comment }}</p>
                            <p>{{ trans(App::getLocale() . '.posted_by') }}: {{ $comment->user->name }}</p>
                            <p>{{ trans(App::getLocale() . '.posted_at') }}: {{ $comment->created_at }}</p>
                            @auth
                                @if (auth()->user()->role === 'admin' || auth()->user()->id === $comment->user_id)
                                    <form action="{{ route('comments.destroy', ['song' => $song->id, 'comment' => $comment->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ trans(App::getLocale() . '.delete_comment') }}</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach

                <!-- Add Comment Form -->
                @auth
                    <div class="card">
                        <div class="card-body">
                            <h3>{{ trans(App::getLocale() . '.add_comment') }}</h3>
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="song_id" value="{{ $song->id }}">
                                <div class="form-group">
                                    <label for="comment">{{ trans(App::getLocale() . '.comment') }}:</label>
                                    <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-secondary mt-3">{{ trans(App::getLocale() . '.add_comment') }}</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
