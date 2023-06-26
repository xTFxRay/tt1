@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>{{ trans(App::getLocale() . '.cart') }}</h1>

                @if ($cartItems->isEmpty())
                    <h2>{{ trans(App::getLocale() . '.empty_cart') }}</h2>
                @else
                    @foreach ($cartItems as $cartItem)
                        <div>
                            <p>{{ trans(App::getLocale() . '.song_name') }}: {{ $cartItem->song->title }}</p>
                            <p>{{ trans(App::getLocale() . '.price') }}: ${{ $cartItem->song->price }}</p>
                            <!-- Add more cart information or functionality as needed -->
                            <form action="{{ route('cart.removeFromCart', ['cart_item_id' => $cartItem->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ trans(App::getLocale() . '.delete') }}</button>
                            </form>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>

@endsection
