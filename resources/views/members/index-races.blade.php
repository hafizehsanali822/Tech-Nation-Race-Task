
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="main-nav">
<div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span>{{ $user->name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item nav-btn-links" href="{{Route('member.logout')}}">
                        {{ __('Logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
</nav>
<main class="py-4">
<div class="container">
    
    <div class="row justify-content-center">
       <div class="alert alert-success"  id="top-success-message" hidden> <span></span> </div>
       <div class="alert alert-danger"  id="top-error-message" hidden> <span></span> </div>
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
                @foreach($races as $race)
                    <tr>
                        <td >{{$race->title}}</td>
                        <td>{{$race->start_date}}</td>
                        <td>{{$race->end_date}}</td>
                        <td class="text-center">{{$race->joinedMembers->count()}}</td>
                        <td>{{$race->winnerMemeber->name ?? ''}}</td>
                        <td>
                          @if(!isset($race->winnerMemeber))
                            <a class="btn btn-info nav-btn-links" href="{{Route('race.join')}}" disabled data-raceid="{{$race->id}}">Join</a>
                            <a class="btn btn-info nav-btn-links" href="{{Route('race.disjoin')}}" data-raceid="{{$race->id}}">DisJoin</a> 
                           @else <p>Winner Annouced</p>
                          @endif
                        </td>
                    </tr>

                @endforeach
           </tbody>
       </table>
   </div>
   {{ $races->links() }}
</div>
</main>
<script src="{{ asset('js/members.js') }}" defer></script>
<script src="{{ asset('js/fcm.js') }}"></script>








