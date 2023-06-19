@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- Welcome text and user info -->
            <div>
                <h1>Hello, {{ Auth::user()->name }}</h1>
                <p>Beatmakers wrld soon</p>
                <ul>
                    <li>Email: {{ Auth::user()->email }}</li>
                    <li>Location: {{ Auth::user()->location }}</li>
                    <li>Joined: {{ Auth::user()->created_at }}</li>
                    <!-- Add more user information as needed -->
                </ul>
                <a href="{{ route('songs.create') }}" class="btn btn-secondary">Add Song</a>


            </div>
        </div>
        <div class="col-md-4">
            <!-- Third part -->
            <div>
                <h2>Third Part</h2>
                <!-- Add content for the third part here -->
            </div>
        </div>
    </div>
</div>
@endsection
