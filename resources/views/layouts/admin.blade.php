<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/home') }}">Laravel</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="mainnav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="mainnav" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(Request::segment(1)=='home') active @endif">
                        <a class="nav-link" href="{{ url('/home') }}">Home  @if(Request::segment(1)=='home') <span class="sr-only">(current)</span> @endif</a>
                    </li>
                    <li class="nav-item @if(Request::segment(2)=='article') active @endif">
                        <a class="nav-link" href="{{ url('/admin/article') }}">Article   @if(Request::segment(2)=='article') <span class="sr-only">(current)</span> @endif</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown @if(Request::segment(1)=='user') active @endif">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}  @if(Request::segment(1)=='user')  <span class="sr-only">(current)</span> @endif <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if( Auth::user()->permission == "admin" )
                                <a class="dropdown-item" href="{{ url('/admin/user') }}">
                                    Users
                                </a>
                                @endif
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
                    </ul>
                <!-- <form class="form-inline my-2 my-md-0">
                    <input class="form-control" type="text" placeholder="Search">
                </form> -->
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
