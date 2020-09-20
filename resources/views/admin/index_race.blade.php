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
                            <a class="btn btn-danger"  onclick="deleteRaceModel({{$race->id}})" >Delete</a> 
                       </td>
                    </tr>

                @endforeach
           </tbody>
       </table>
   </div>
   
   
</div>


<div class="modal fade" id="modal-delete-confirm">
  <div class="modal-dialog">
  <form action="{{route('admin.race.delete')}}" novalidate >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="race_id" id="race-id">
        <p>Are you sure? You want to delete this Product</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Yes</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </from>
  </div> 
  <!-- /.modal-dialog -->
</div>
@endsection
<script>
    function deleteRaceModel($id)
    {
        $('#race-id').val($id);
        $('#modal-delete-confirm').modal('toggle');
    }
</script>

