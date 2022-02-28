@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add {{ $page }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('manager.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">{{ $page }} Page</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="card card-info">
    <form role="form" method="POST" action="{{route('manager.slider.store')}}" class="signup" id="signup" enctype="multipart/form-data">
      <div class="card-body">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text"  class="form-control max" id="name" placeholder="Enter name" name="name" autocomplete="off" autofocus value="{{ old('name') }}">
          @error('name')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
       
        <div class="form-group">
          <label for="image">Choose Slider</label>
          <div class="input-group">
            <input type="file" class="form-control d-none" id="image" name="image" value="{{ old('image') }}">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQl1xtOkMGh312RKiJXUPbwyODQ7hdHgHFqYR5RwBGHiKaKz9eO&s" id="profile-img-tag" width="200px" onclick="document.getElementById('image').click();" alt="your image" class="img-thumbnail img-fluid editback-gallery-img center-block"  />
            @error('image')
            <span class="text-danger font-italic" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        
      </div>
      <div class="card-footer justify-content-between">
        <button type="submit" class="btn btn-info text-capitalize">Save</button>
      </div>
    </form>
  </div>
</section>
@endsection
@push('javascript')
{{-- <script src="{{URL::to('/')}}/backend/js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
  $("#signup").validate({
    rules: {
      name: "required"
    },
    messages: {
      name: " name field is required **"
    },
    highlight: function(element) {
     $(element).css('background', '#ffdddd');
     $(element).css('border-color', 'red');
    },
    unhighlight: function(element) {
     $(element).css('background', '#ffffff');
     $(element).css('border-color', 'green');
    }
  });
});
</script>
<script>
function myFunction(inputtxt) {
  var letters = /^[a-z]+$/;
  if(inputtxt.value.match(letters))
  {
  alert('Your name have accepted : you can try another');
  return true;
  }
  else
  {
  alert('small alphabet characters only');
  return false;
  }
  alert("You pressed a key inside the input field");
}
</script> --}}
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#profile-img-tag').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#image").change(function(){
    // alert("milan");
    readURL(this);
  });
</script>
{{-- <script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      console.log(reader);

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function() {
    readURL(this);
    console.log("milan");
  });
</script> --}}

@endpush