@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h3 class="text-capitalize">Dr.<small> {{$doctors->name}}</small></h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('manager.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Doctor's schedule Page</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="card card-info">
    <form role="form" method="POST" action="{{route('manager.doctorhasday.update',$doctorhasdays->id)}}">
      <div class="card-body">
        @csrf
        @method('PATCH')
        <input type="hidden" name="doctor_id" id="doctor_id" value="{{$doctors->id}}">
        <div class="form-group">
          <label for="day_id" class="control-label">Day <span class="text-danger">*</span></label>
          <select class="form-control" name="day_id" id="day_id">
            <option value="">Select Day</option>
            @foreach ($days as $key => $day)
            <option value="{{ $day->id }}" {{ $doctorhasdays->day_id == $day->id ? 'selected' : ''}}>
              {{$day->name}}
            </option>
            @endforeach
          </select>
          @error('day_id')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="card-footer justify-content-between">
        <button type="submit" class="btn btn-info text-capitalize">Update</button>
      </div>
    </form>
  </div>
</section>
@endsection
