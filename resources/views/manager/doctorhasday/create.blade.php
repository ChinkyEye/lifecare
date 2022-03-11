@extends('manager.main.main')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
@endpush
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
    <form role="form" method="POST" action="{{route('manager.doctorhasday.store')}}">
      <div class="card-body" {{-- id="dynamicAddRemove" --}} id="entry-table">
        @csrf
        <input type="hidden" name="doctor_id" id="doctor_id" value="{{$doctors->id}}">
        <div class="form-group">
          <label for="day_id" class="control-label">Day <span class="text-danger">*</span></label>
          <select class="form-control" name="day_id" id="day_id">
            <option value="">Select Day</option>
            @foreach ($days as $key => $day)
            <option value="{{ $day->id }}" {{ old('hospital_id') == $day->id ? 'selected' : ''}}>
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
        <div class="row" id="main-entry">
          <div class="bootstrap-timepicker col-md-6">
            <div class="form-group">
              <label for="from_time">From Time:<span class="text-danger">*</span></label>
              <div class="input-group date" id="from_time" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input lol" data-target="#from_time" name="from_time[]" value="{{ old('from_time') }}">
                <div class="input-group-append" data-target="#from_time" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                </div>
              </div>
              @error('from_time')
              <span class="text-danger font-italic" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="bootstrap-timepicker col-md-5">
            <div class="form-group">
              <label for="to_time">To Time:<span class="text-danger">*</span></label>
              <div class="input-group date" id="to_time" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#to_time" name="to_time[]" value="{{ old('to_time') }}">
                <div class="input-group-append" data-target="#to_time" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                </div>
              </div>
              @error('to_time')
              <span class="text-danger font-italic" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-md-1 d-flex justify-content-md-center align-items-center w-100">
              <button type="button" name="add" id="add_more" class="btn btn-xs btn-outline-primary"><i class="fas fa-plus"></i></button>
              {{-- <button type="button" name="add" id="dynamic-ar" class="btn btn-xs btn-outline-primary"><i class="fas fa-plus"></i></button> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
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

<script>
    $('#from_time').datetimepicker({
      format: 'LT'
    })
</script>
<script>
    $('#to_time').datetimepicker({
      format: 'LT'
    })
</script>
{{-- <script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script> --}}
<script type="text/javascript">
    var max_fields      = 14; 
    var x = 0;
    var wrapper         = $("#entry-table"); 
    $("body").on("click", "#add_more", function(event){
        if(x < max_fields){
            x++;
            var $cloned = $("#main-entry:first").clone();
            $cloned.append('<a href="javascript:void(0)" class="remove_field btn btn-danger btn-sm"><i class="mdi mdi-close" aria-hidden="true"></i></a>');
            wrapper.append($cloned);
        }
        else
            alertify.alert("only max 15 entries");
    });
    wrapper.on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); 
        x--;
    });
</script>
@endpush