<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="store_fcmtoken_url" content="{{ Route('save.device.token') }}">
    <meta name="user_id" content="{{ Auth::check() ? \Auth::User()->id : '' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    
    @auth
    <script src="https://www.gstatic.com/firebasejs/6.3.4/firebase.js"></script>
    <script src="{{ asset('js/fcm.js') }}"></script>
    @endauth

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div  id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                          <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
       
        <main class="container-fluid pt-2">
        <div  class="row">
         
           @auth
            <div class="col-2">
                 <!-- Main Sidebar Container -->
                <aside class="main-sidebar">
                    <!-- Sidebar Menu -->
                     <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" id="nav-link-container">
                           <li class="nav-item" >
                                <a href="{{route('admin.index.races')}}" class="nav-link">
                                <p>All Races</p>
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a href="{{route('admin.show.race.form')}}" class="nav-link">
                                <p>Create Race</p>
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a href="{{route('admin.race.winner.form')}}" class="nav-link">
                                <p>Select Winner</p>
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a href="{{route('admin.view.notifications')}}" class="nav-link">
                                <p>Notifications</p>
                                </a>
                            </li>
                        </ul>
                     </nav>

                </aside>
             </div>
             <div class="col-10 pt-2">
                @yield('content')
              </div>
              @else
                <div class="col-12 pt-2">
                  @yield('content')
                </div>
            @endauth
           
        </div>
            
        </main>
    </div>
    @yield('specific-page-scripts')
</body>
</html>
