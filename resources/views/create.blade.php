@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Add Song</div>
                    <div class="card-body">
                        <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tags">Tags</label>
                                <input type="text" name="tags" id="tags" class="form-control" required>
                                <small class="text-muted">Enter tags separated by commas (e.g., tag1, tag2, tag3)</small>
                            </div>

                            <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Add Song</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
