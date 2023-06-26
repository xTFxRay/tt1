@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- Welcome text and user info -->
                <div class="d-flex align-items-center">
                    <div>
                        <h1>{{ trans(App::getLocale() . '.hello', ['name' => Auth::user()->name]) }}</h1>
                        <ul>
                            <li>{{ trans(App::getLocale() . '.email') }}: {{ Auth::user()->email }}</li>
                            <li>{{ trans(App::getLocale() . '.joined') }}: {{ Auth::user()->created_at }}</li>
                            <li>{{ trans(App::getLocale() . '.role') }}: {{ Auth::user()->role }}</li>
                            <!-- Add more user information as needed -->
                        </ul>
                    </div>
                    <!-- Profile picture -->
                    @if (Auth::user()->image)
                        <img src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->image) }}" alt="{{ trans(App::getLocale() . '.profile_picture') }}" class="img-thumbnail" style="width: 200px; height: 200px;">
                    @else
                        <p>{{ trans(App::getLocale() . '.no_image') }}</p>
                    @endif
                </div>
                <a href="{{ route('songs.create') }}" class="btn btn-secondary" style="margin-top: 10px;">{{ trans(App::getLocale() . '.add_song') }}</a>

                <!-- Upload picture button -->
                <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
                    @csrf
                    <input type="file" name="profile_picture">
                    <button type="submit" class="btn btn-secondary">{{ trans(App::getLocale() . '.upload_picture') }}</button>
                </form>

                <!-- Your Tracks -->
                <h2 class="song-heading">{{ trans(App::getLocale() . '.your_tracks') }}</h2>
                @foreach($songs as $song)
                    @if($song->user_id === auth()->user()->id)
                        <div class="card mb-3">
                            <div class="card-body">
                                <a href="{{ route('songs.show', ['song' => $song->id]) }}" class="btn btn-secondary mb-2" tabindex="-1" role="button" aria-disabled="true">{{ $song->title }}</a>
                                @if ($song->user)
                                    <p class="card-text">{{ trans(App::getLocale() . '.artist') }}: {{ $song->user->name }}</p>
                                @else
                                    <p class="card-text">{{ trans(App::getLocale() . '.artist') }}: {{ trans(App::getLocale() . '.unknown') }}</p>
                                @endif
                                <p class="card-text">{{ trans(App::getLocale() . '.price') }}: ${{ $song->price }}</p>
                                <p class="card-text">{{ trans(App::getLocale() . '.likes') }}: {{ $song->likes }}</p>

                                
                                <a href="{{ route('comments.show', ['song' => $song->id]) }}" class="btn btn-secondary">{{ trans(App::getLocale() . '.view_comments') }}</a>
                                
                                <a href="{{ route('songs.edit', ['song' => $song->id]) }}" class="btn btn-secondary">{{ trans(App::getLocale() . '.edit') }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>


            
            <div class="col-md-4 mt-4">
 <!-- Sorting Dropdown -->
 <div class="mb-3">
    <h2 class="song-heading">{{ trans(App::getLocale() . '.sort_songs') }}</h2>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ trans(App::getLocale() . '.sort_by') }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
            <li><a class="dropdown-item" href="{{ route('songs.index') }}">{{ trans(App::getLocale() . '.recent_songs') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('songs.index', ['sort' => 'likes']) }}">{{ trans(App::getLocale() . '.most_liked') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('songs.index', ['sort' => 'title']) }}">{{ trans(App::getLocale() . '.alphabetical_order') }}</a></li>
        </ul>
    </div>
</div>


<!-- Song List -->
<div>
    <h2 class="song-heading">{{ trans(App::getLocale() . '.song_list') }}</h2>
    @foreach($songs as $song)
        <div class="card mb-3">
            <div class="card-body">
                <a href="{{ route('songs.show', ['song' => $song->id]) }}" class="btn btn-secondary mb-2 recent-song" tabindex="-1" role="button" aria-disabled="true">{{ $song->title }}</a>
                @if ($song->user)
                    <p class="card-text">{{ trans(App::getLocale() . '.artist') }}: {{ $song->user->name }}</p>
                @else
                    <p class="card-text">{{ trans(App::getLocale() . '.artist') }}: {{ trans(App::getLocale() . '.unknown') }}</p>
                @endif
                <p class="card-text">{{ trans(App::getLocale() . '.price') }}: ${{ $song->price }}</p>
                <!-- Display Like Count -->
                <p class="card-text">{{ trans(App::getLocale() . '.likes') }}: {{ $song->Likes }}</p>
                <a href="{{ route('comments.show', ['song' => $song->id]) }}" class="btn btn-secondary">{{ trans(App::getLocale() . '.view_comments') }}</a>
                <form action="{{ route('cart.addToCart', ['song_id' => $song->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-secondary float-end">{{ trans(App::getLocale() . '.add_to_cart') }}</button>
                </form>

            </div>
        </div>
    @endforeach
</div>




                </div>
            </div>
        </div>
    </div>
@endsection


