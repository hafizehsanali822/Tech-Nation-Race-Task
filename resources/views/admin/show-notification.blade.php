@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Title</th>
                <th scope="col">Message</th>
               
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                   <tr> 
                      <td >{{$notification->title}}</td> 
                      <td >{{$notification->message}}</td> 
                    </tr>
                @endforeach
           </tbody>
       </table>
   </div>
</div>
@endsection
