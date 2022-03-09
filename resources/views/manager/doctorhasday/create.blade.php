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
    <form role="form" method="POST" action="{{route('manager.doctor.store')}}" enctype="multipart/form-data">
      <div class="card-body">
        @csrf
        <div class="form-group">
          <label for="name">Doctor Name<span class="text-danger">*</span></label>
          <input type="text"  class="form-control max" id="name" placeholder="Enter name" name="name" autocomplete="off" autofocus value="{{ old('name') }}">
          @error('name')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="address_id" class="control-label">Address <span class="text-danger">*</span></label>
          <select class="form-control" name="address_id" id="address_id">
            <option value="">Select Day</option>
            @foreach ($hospitals as $key => $hospital)
            <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : ''}}>
              {{$hospital->name}}
            </option>
            @endforeach
          </select>
          @error('address_id')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="specialist_id" class="control-label">Specialist <span class="text-danger">*</span></label>
          <select class="form-control" name="specialist_id" id="specialist_id">
            <option value="">Select Your Specialist</option>
            @foreach ($specialists as $key => $specialist)
            <option value="{{ $specialist->id }}" {{ old('specialist_id') == $specialist->id ? 'selected' : ''}}>
              {{$specialist->name}}
            </option>
            @endforeach
          </select>
          @error('specialist_id')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="hospital_id" class="control-label">Hospital<span class="text-danger">*</span></label>
          <select class="form-control" name="hospital_id" id="hospital_id">
            <option value="">Select Your Hospital</option>
            @foreach ($hospitals as $key => $hospital)
            <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : ''}}>
              {{$hospital->name}}
            </option>
            @endforeach
          </select>
          @error('hospital_id')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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