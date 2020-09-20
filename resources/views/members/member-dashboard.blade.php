@extends('members.layouts.app')

@section('content')
<div id='app' id='dynamic-content'>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="main-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                        @if(!isset($token))
                            <ul class="navbar-nav ml-auto" id>
                            <li class="nav-item">
                                    <a class="nav-link nav-btn-links" id='login' href="{{ route('member.login.form') }}">{{ __('Login') }}</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link nav-btn-links" href="{{ route('member.register.form') }}">{{ __('Register') }}</a>
                                </li>
                            </ul>
                            @else
                            <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <span>{{ $user->name}}</span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item nav-btn-links"  href="{{Route('member.logout')}}">
                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                        @endif     
                            
                    
                </div>
            </div>
     </nav>
    <main class="py-4">
            @if( !isset($apiToken))
                <div class="container" >
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-danger"  id="top-error-message" hidden>
                                <span></span>
                            </div>
                            <div class="card">
                                <div class="card-header">{{ __('Login') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('member.login') }}" id="login_form">
                                    

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            
                                                    <span class="invalid-feedback" role="alert" hidden>
                                                        <strong>{{ $message ?? '' }}</strong>
                                                    </span>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                                            
                                                    <span class="invalid-feedback" role="alert" hidden>
                                                        <strong>{{ $message ?? '' }}</strong>
                                                    </span>
                                            
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary form-control">
                                                    {{ __('Login') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a> -->
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>         
            @else
                <div class="container">
                    <div class="row justify-content-center">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col"  class="text-center">Joined User</th>
                                <th scope="col">Winner</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($races))
                                    @foreach($races as $race)
                                        <tr>
                                            <td >{{$race->title}}</td>
                                            <td>{{$race->start_date}}</td>
                                            <td>{{$race->end_date}}</td>
                                            <td class="text-center">{{$race->joinedMembers->count()}}</td>
                                            <td>{{$race->winnerMemeber->name ?? ''}}</td>
                                            <td>
                                                @if(!isset($race->winnerMemeber))
                                                   <a class="btn btn-info" onclick="joinDisJoinRace({{$race->id}}, '{{Route('race.join')}}')">Join</a>
                                                    <a class="btn btn-info"  onclick="joinDisJoinRace({{$race->id}}, '{{Route('race.disjoin')}}')">DisJoin</a> 
                                                @endif
                                                </td>
                                        </tr>

                                    @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>
                </div>
            @endif    
    </main>
    <script src="{{ asset('js/members.js') }}" defer></script>
   
</div>
@endsection
@section('specific-page-scripts')
@endsection
