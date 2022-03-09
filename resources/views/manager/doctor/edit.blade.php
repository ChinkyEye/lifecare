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
    <form role="form" method="POST" action="{{route('manager.doctor.update', $doctors->id)}}" enctype="multipart/form-data">
      <div class="card-body">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Doctor Name<span class="text-danger">*</span></label>
          <input type="text"  class="form-control max" id="name" value="{{$doctors->name}}" name="name" autocomplete="off" autofocus value="{{ old('name') }}">
          @error('name')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="address_id" class="control-label">Address <span class="text-danger">*</span></label>
          <select class="form-control" name="address_id" id="address_id">
            <option value="">Select Your Address</option>
            @foreach ($addresses as $key => $address)
            <option value="{{ $address->id }}" {{ $doctors->address_id == $address->id ? 'selected' : ''}}>
              {{$address->name}}
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
            <option value="{{ $specialist->id }}" {{ $doctors->specialist_id == $specialist->id ? 'selected' : ''}}>
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
            <option value="{{ $hospital->id }}" {{ $doctors->hospital_id == $hospital->id ? 'selected' : ''}}>
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
        <div class="form-group">
          <label for="about">About</label>
          <textarea class="form-control" id="about" name="about" rows="3" placeholder="Write something here..." value="{{old('about')}}">{{$doctors->about}}</textarea>
          {{-- <input type="text"  class="form-control max" id="about" placeholder="Enter description" name="about" autocomplete="off" autofocus value="{{ old('about') }}" value="{{$doctors->about}}"> --}}
          @error('about')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="experience">Experience<span class="text-danger">*</span></label>
          {{-- <input type="text"  class="form-control max" id="experience" placeholder="Enter experience" name="experience" autocomplete="off" autofocus value="{{ old('experience') }}"> --}}
          <textarea class="ckeditor form-control" rows="10" cols="20" name="experience" placeholder="Enter Details.....">{{$doctors->experience}}</textarea>
          @error('experience')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="nmc_no">NMC no<span class="text-danger">*</span></label>
          <input type="text"  class="form-control max" id="nmc_no" placeholder="Enter nmc no" name="nmc_no" autocomplete="off" value="{{$doctors->nmc_no}}" autofocus value="{{ old('nmc_no') }}">
          @error('nmc_no')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="qualification">Qualification<span class="text-danger">*</span></label>
          <textarea class="form-control" id="qualification" rows="3" name="qualification" placeholder="Write something here..." value="{{ $doctors->qualification }}" >{{$doctors->qualification}}</textarea>
          {{-- <input type="text"  class="form-control max" id="qualification" placeholder="Enter qualification" name="qualification" autocomplete="off" autofocus value="{{ old('qualification') }}"> --}}
          @error('qualification')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
       
        <div class="form-group">
          <label for="image">Choose Image<span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="file" class="form-control d-none" id="image" name="image" value="{{ old('image') }}">
            <img src="{{URL::to('/')}}/images/doctor/{{$doctors->image}}" id="profile-img-tag" width="200px" onclick="document.getElementById('image').click();" alt="your image" class="img-thumbnail img-fluid editback-gallery-img center-block"  />
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