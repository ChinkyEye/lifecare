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
    <form role="form" method="POST" action="{{route('manager.prescription.store')}}" enctype="multipart/form-data">
      <div class="card-body">
        @csrf
        <div class="form-group">
          <label for="address_id" class="control-label">Prescribed by<span class="text-danger">*</span></label>
          <select class="form-control" name="doctor_id" id="doctor_id">
            <option value="">Select Doctor</option>
            @foreach ($doctors as $key => $doctor)
            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : ''}}>
              {{$doctor->name}}
            </option>
            @endforeach
          </select>
          @error('doctor_id')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
         <div class="form-group">
          <label for="examination_mse" class="control-label">Examination mse<span class="text-danger">*</span></label>
          <input type="text" class="form-control max" name="examination_mse" placeholder="Enter here...." autocomplete="off" autofocus value="{{ old('examination_mse') }}">
          @error('examination_mse')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div> 
        <div class="form-group">
          <label for="clinical_note" class="control-label">Clinical Note<span class="text-danger">*</span></label>
          <input type="text" class="form-control max" name="clinical_note" placeholder="Enter here...." autocomplete="off" autofocus value="{{ old('clinical_note') }}">
          @error('clinical_note')
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
<!-- @push('javascript')
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
</script> -->
<!-- {{-- <script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function() {
    readURL(this);
  });
</script> --}} -->
<!-- @endpush -->