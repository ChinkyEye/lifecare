@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
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
  <a href="{{ route('manager.doctorhasday.create',$doctors->id)}}" class="btn btn-sm btn-info text-capitalize rounded-0">Add Doctor's Schedule </a>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered table-hover m-0 w-100 table-sm">
        <thead class="bg-dark">
          <tr class="text-center">
            <th width="10">SN</th>
            <th class="text-left">Working Days</th>
            <th>Available Time</th>
            <th>Status</th>
          </tr>
        </thead> 
        <tbody>
          @foreach($datas as $key => $data)
          <tr class="text-center">
            <td>{{$key + 1}}</td>
            <td class="text-left">{{$data->getDayName->name}}</td>
            <td>
              @foreach($data->getDoctorDayTime as $key => $daytime)
              {{$daytime->from_time}} - {{$daytime->to_time}}

              <form action='javascript:void(0)' data_url="{{route('manager.doctorhasdaytime.destroy',$daytime->id)}}" method='post' class='d-inline-block'  data-placement='top' title='Permanent Delete' onclick='myFunction(this)'>
                <input type='hidden' name='_token' value='".csrf_token()."'>
                <input name='_method' type='hidden' value='DELETE'>
                <button class='btn btn-xs btn-outline-danger' type='submit' ><i class="fas fa-times text-danger"></i></a></button>
              </form>  ,
              {{-- <a href="javascript:void(0)" title="Click to Cancel Booking" onclick="myFunction({{$daytime->id}})"><i class="fas fa-times text-danger"></i></a>, --}}
              @endforeach
            </td>
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
<script>
  function myFunction(el) {
    // alert(el);
    const url = $(el).attr('data_url');
      var token = $('meta[name="csrf-token"]').attr('content');
      swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then(function(value) {
        if(value == true){
          $.ajax({
            url: url,         
            type: "POST",
            data: {
              _token: token,
              '_method': 'DELETE',
            },
            success: function (data) {
              swal({
                title: "Success!",
                type: "success",
                text: "Click OK",
                icon: "success",
                showConfirmButton: false,
              }).then(location.reload(true));
              
            },
            error: function (data) {
              swal({
                title: 'Opps...',
                text: "Please refresh your page",
                type: 'error',
                timer: '1500'
              });
            }
          });
        }else{
          swal({
            title: 'Cancel',
            text: "Data is safe.",
            icon: "success",
            type: 'info',
            timer: '1500'
          });
        }
      });
  }
</script>
@endpush