@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Edit {{ $page }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">{{ $page }} Page</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="card">
    <form role="form" method="POST" action="{{ route('manager.slider.update',$sliders->id)}}" enctype="multipart/form-data">
       @method('PATCH')
       @csrf
      <div class="modal-body" >
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text"  class="form-control max" id="name" placeholder="Enter Insurance Id" name="name"  autocomplete="off" value="{{ $sliders->name }}">
          </div>
          <div class="form-group">
            <label for="image">Choose Image</label>
            <input type="hidden" value="{{$sliders->image}}">
            <div class="input-group">
              <input type="file" class="form-control d-none" id="image" name="image"  value="{{$sliders->image}}" >
              <img src="{{URL::to('/')}}/images/slider/{{$sliders->image}}" id="profile-img-tag" width="200px" onclick="document.getElementById('image').click();" alt="your image" class="img-thumbnail img-fluid editback-gallery-img center-block"  />
              <!-- <img src="{{URL::to('/')}}/images/slider/{{$sliders->name}}/{{$sliders->image}}" id="profile-img-tag" width="200px" onclick="document.getElementById('image').click();" alt="your image" class="img-thumbnail img-fluid editback-gallery-img center-block"  /> -->
            </div>
            @error('image')
            <span class="text-danger font-italic" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" class="btn btn-info text-capitalize">Update Slider</button>
      </div>
    </form>
  </div>
</section>
@endsection
@push('javascript')
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
    readURL(this);
  });
</script>
@endpush