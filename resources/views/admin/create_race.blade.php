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
       <form action="{{route('admin.create.race')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="title">Race  Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"  required placeholder="Enter Race Title">
            </div>

            <div class="form-group col-md-8">
              <label for="start_date">Start Date</label>
              <input type="date" class="form-control" name="start_date" id="start-date" value="{{ old('start_date')}}" required placeholder="Enter Start Date">
            </div>

            <div class="form-group col-md-8">
              <label for="end_date">End Date</label>
              <input type="date" class="form-control" name="end_date" id="end-date" value="{{ old('end_date')}}" required placeholder="Enter Product SKU">
            </div>

            <div class="form-group col-md-8">
              <img src="" id="display-image" style="max-width: 100%;" > </img>
           </div>


            <div class="form-group col-md-8">
              <label for="image">Select Image</label>
              <input type="file" name="image" id="image" value="{{ old('image')}}"  >
            </div>
          </div>
         

          
          <div>
             <button type="submit" class="btn btn-primary" >Submit</button>
          </div>
          
        </form>
        
        
      </div><!--/. container-fluid -->
    </section> <!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('specific-page-scripts')
<script>
$(document).ready(function(){
        $("#image").change(function(){  readURL(this);  });

        function readURL(input) 
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#display-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endsection
