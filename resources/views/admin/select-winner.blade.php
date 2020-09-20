@extends('admin.layouts.app')

@section('content')
<div class="wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid ">
        @if(session()->has('success_message'))
            <div class="alert alert-success col-8">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger col-8">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <meta name="races_with_joined_members" content="{{json_encode($races)}}">
       <form action="{{route('admin.race.annouce.winner')}}" method="POST" >
        {{ csrf_field() }}
       
          <div class="form-row">
             <div class="form-group col-md-7">
                <label for="races">Race Title</label>
                <Select class="form-control" name="races_select" id="races-select">
                  <Option disabled selected>Select Race</Option>
                  @foreach($races as $race)
                    <Option value="{{$race->id}}" {{ (old('race') == $race->id ? "selected":"") }}>
                    {{$race->title}}
                      <!-- @if($race->winnerMemeber != null)
                        ( Winner: {{$race->winnerMemeber->name}}) 
                      @endif -->
                    </Option>
                  @endforeach
                </Select>
            </div>

            <div class="form-group col-md-7">
                <label for="race">Member Name</label>
                <Select class="form-control" name="members_select" id="members-select">
                  <Option disabled selected>Select Winner Member</Option>
                
                </Select>
            </div>

          </div>          
          <div>
             <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          
        </form>
        
        
      </div><!--/. container-fluid -->
    </section> <!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection
@section('specific-page-scripts')
<script>
     //get all joined races data with members through meta
     var allRacesWithMembers = $("meta[name='races_with_joined_members']").attr('content');
         allRacesWithMembers = JSON.parse(allRacesWithMembers);	
        $('#races-select').on('change', function() {
            var selectedRaceId = this.value;
            var selectedRace = allRacesWithMembers.filter((allRacesWithMembers) => { return allRacesWithMembers.id == selectedRaceId; });
            var selectedRaceMembers = selectedRace[0].joined_members;
            if(selectedRaceMembers !== 'undefined')
            {
                $('#members-select').empty();
                selectedRaceMembers.forEach(function(raceMember){
                    console.log(raceMember);
                    //Add each member to selectlist  for winner selection
                    $('#members-select').append($('<option>', { 
                        value: raceMember.id,
                        text : raceMember.name 
                    }));
    
               });
            }
        });
</script>
@endsection

