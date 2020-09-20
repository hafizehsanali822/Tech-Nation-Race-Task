@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                <!-- <th scope="col">Image</th> -->
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
                        <!-- <td >  <img src="{{$race->image}}" width='50px' id="display-image"> </img></td> -->
                        <td >{{$race->title}}</td>
                        <td>{{$race->start_date}}</td>
                        <td>{{$race->end_date}}</td>
                        <td class="text-center">{{$race->joinedMembers->count()}}</td>
                        <td>{{$race->winnerMemeber->name ?? ''}}</td>
                        <td>
                           <a class="btn btn-success" href="{{route('admin.edit.race.form', $race->id )}}">Edit</a>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-confirm">Delete</a> 
                       </td>
                    </tr>

                @endforeach
           </tbody>
       </table>
   </div>
</div>
@endsection

