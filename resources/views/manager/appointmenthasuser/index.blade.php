@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header"></section>
<section class="content">
  <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered table-hover m-0 w-100 table-sm">
        <thead class="bg-dark">
          <tr class="text-center">
            <th width="10">SN</th>
            <th class="text-left">User Name</th>
            <th>Doctor Name</th>
            <th>Appointed Day</th>
            <th>Appointed Time</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead> 
        <tbody>
          @foreach($datas as $key => $data)
          <tr class="text-center {{$data->is_active == 1 ? '' : 'bg-light-danger'}}">
            <td>{{$key + 1}}</td>
            <td>{{$data->getAppointmentUser->name}}</td>
            <td>{{$data->getDoctor->name}}</td>
            <td>{{$data->getAppointmentDay->getDayName->name}}</td>
            <td>{{$data->getAppointmentDayTime->from_time}} - {{$data->getAppointmentDayTime->to_time}}</td>
            <td>
              <a href="{{ route('manager.appointmenthasuser.active',$data->id) }}" data-placement="top" title="{{ $data->is_active == '1' ? 'Click to deactivate' : 'Click to activate' }}">
                <i class="nav-icon fas {{ $data->is_active == '1' ? 'fa-check-circle':'fa-times-circle text-danger'}}"></i>
              </a>
            </td>
            <td>
               <a href="{{ route('manager.appointmenthasuser.show', $data->id) }}" class="btn btn-xs btn-outline-info" title="view"><i class="fas fa-eye"></i></a>
            </td>

          </tr>
          @endforeach
        </tbody>             
      </table>
    </div>
    {!! $datas->links() !!}
  </div>
</section>
@endsection
@push('javascript')
<script>
  function myFunction(el) {
    const url = $(el).attr('data_url');
    console.log(url);
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