@extends('admin.layouts.app')

@section('content')
        @if(session()->has('success_message'))
            <div class="alert alert-success col-8">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @if (session()->has('error_message'))
            <div class="alert alert-danger col-8">
                <ul>
                  
                    {{ session()->get('error_message') }}
                    
                </ul>
            </div>
        @endif
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($users))
                    @foreach($users as $user)
                        <tr>
                            <td >{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                        </tr>

                    @endforeach
                @endif
           </tbody>
       </table>
   </div>
   
   
</div>
</div>
@endsection


