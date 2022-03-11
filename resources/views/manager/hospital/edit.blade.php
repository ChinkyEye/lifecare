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
    <form role="form" method="POST" action="{{ route('manager.hospital.update',$hospitals->id)}}" enctype="multipart/form-data">
       @method('PATCH')
       @csrf
       <div class="modal-body" >
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text"  class="form-control max" id="name" placeholder="Enter Insurance Id" name="name"  autocomplete="off" value="{{ $hospitals->name }}">
        </div>
        <div class="form-group">
          <label for="address_id" class="control-label">Address <span class="text-danger">*</span></label>
          <select class="form-control" name="address_id" id="address_id">
            <option value="">Select Your Address</option>
            @foreach ($addresses as $key => $address)
            <option value="{{ $address->id }}" {{$address->id == $hospitals->address_id ? 'selected' : ''}} >
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
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" class="btn btn-info text-capitalize">Update Hospital</button>
      </div>
    </form>
  </div>
</section>
@endsection
@push('javascript')
@endpush