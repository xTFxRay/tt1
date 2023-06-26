<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans(App::getLocale() . '.JuicyBeatsWorld') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ trans(App::getLocale() . '.JuicyBeatsWorld') }}
                </a>
                <div class="input-group mb-6 form-outline w-50">
                <form action="{{ route('song.search') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" class="form-control me-2" name="search" id="search" placeholder="{{ trans(App::getLocale() . '.Search') }}" aria-label="{{ trans(App::getLocale() . '.Search') }}">
                    <button class="btn btn-secondary" type="submit">{{ trans(App::getLocale() . '.Search') }}</button>
                </form>
              
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">{{ trans(App::getLocale() . '.Keywords') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ trans(App::getLocale() . '.Artist') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ trans(App::getLocale() . '.Song') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">{{ trans(App::getLocale() . '.Sound kits') }}</a></li>
                    </ul>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ trans(App::getLocale() . '.Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans(App::getLocale() . '.Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('cart.index') }}">
                                        {{ trans(App::getLocale() . '.Cart') }}
                                    </a>   
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ trans(App::getLocale() . '.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <div class="nav-item dropdown ms-2">
                            <a id="navbarDropdown" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ trans(App::getLocale() . '.Language') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => 'en']) }}">
                                    EN
                                </a>
                                <a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => 'lv']) }}">
                                    LV
                                </a>
                            </div>
                        </div>


                                        
        <!-- Dropdown menu links -->
    </ul>
    </div>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
</body>
</html>
