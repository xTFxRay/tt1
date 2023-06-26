@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ trans(App::getLocale() . '.add_song') }}</div>
                    <div class="card-body">
                    <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title">{{ trans(App::getLocale() . '.title') }}</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-3">
                            <label for="price">{{ trans(App::getLocale() . '.price') }}</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">{{ trans(App::getLocale() . '.description') }}</label>
                            <textarea class="form-control" name="description" placeholder="{{ trans(App::getLocale() . '.leave_description') }}" style="height: 100px"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="keyword">{{ trans(App::getLocale() . '.keyword') }}</label>
                            <input type="text" name="keyword" id="keyword" class="form-control" required>
                        </div>

                        <!-- File Upload -->
                        <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">{{ trans(App::getLocale() . '.upload') }}</label>
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">{{ trans(App::getLocale() . '.add') }}</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
