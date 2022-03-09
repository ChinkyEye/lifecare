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
  <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered table-hover m-0 w-100 table-sm">
        <thead class="bg-light">
          <tr class="text-center">
            <th width="10">SN</th>
            <th>Available Time</th>
            <th>Status</th>
          </tr>
        </thead> 
        <tbody>
          @foreach($doctorhasdaytime as $key => $data)
          <tr class="text-center">
            <td>{{$key + 1}}</td>
            <td>{{$data->from_time}} - {{$data->to_time}}</td>
            <td>
              
            </td>
          </tr>
          @endforeach
        </tbody>             
      </table>
    </div>
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
@endpush