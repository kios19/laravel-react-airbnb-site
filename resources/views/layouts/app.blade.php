<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tibit') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/mediaelement-and-player.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/typed.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet" defer>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css" rel="stylesheet" defer>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/purple/pace-theme-flash.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mediaelementplayer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rangeslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('fonts/flaticon/font/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/icomoon/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!--nav class="site-navbar py-2 bg-white navbar navbar-expand-md navbar-light bg-white shadow-sm"-->
        <nav class="site-navbar py-2 bg-white navbar navbar-expand-md" >
            <div class="container">
                <a class="navbar-brand text-black h2 mb-0" href="{{ url('/home') }}">
                    {{ config('app.name', 'Tibit') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">
                        @if (!Auth::guest())
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li class=""><a href="/rooms"><span>Rooms</span></a></li>
                            </ul>
                        </nav>
                        @endif
                        @if (!Auth::guest())
                        @if (Auth::user()->is_admin == 1)
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li class=""><a href="/rooms/create"><span>Create Listing</span></a></li>
                            </ul>
                        </nav>
                        @endif

                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li class=""><a href="/history"><span>Bookings</span></a></li>
                            </ul>
                        </nav>

                        @endif
                        <!-- Authentication Links -->
                        @guest
                        <!--nav class="site-navigation position-relative text-right" role="navigation">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        </nav-->
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li class=""><a href="{{ route('login') }}"><span>{{ __('Login') }}</span></a></li>
                            </ul>
                        </nav>
                            @if (Route::has('register'))
                            <!--nav class="site-navigation position-relative text-right" role="navigation">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            </nav-->
                            <nav class="site-navigation position-relative text-right" role="navigation">
                                <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                                    <li class=""><a href="{{ route('register') }}"><span>{{ __('Register') }}</span></a></li>
                                </ul>
                            </nav>

                            @endif
                        @else
                        <nav class="site-navigation position-relative text-right" role="navigation">

                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">


                              <li class="has-children active">
                                <a><span>{{ Auth::user()->name }}</span></a>
                                <ul class="dropdown">
                                  <li><a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                                </ul>
                              </li>

                            </ul>
                          </nav>
                        <!--nav class="site-navigation position-relative text-right" role="navigation">
                            <li class="has-children">
                                <li id="navbarDropdown" class="has-children" nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </li>

                                <div class="dropdown-menu dropdown-menu-right has-children" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </nav-->
                        @endguest
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
