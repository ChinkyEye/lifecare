@extends('admin.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header"></section>
<section class="content">
  <a href="{{ route('admin.slider.create')}}" class="btn btn-sm btn-info text-capitalize rounded-0">Add {{ $page }} </a>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered table-hover m-0 w-100 table-sm">
        <thead class="bg-dark">
          <tr class="text-center">
            <th width="10">SN</th>
            <th class="text-left">Name</th>
            <th>Image</th>
            <th width="10">Status</th>
            <th width="150">Created By</th>
            <th width="100">Action</th>
          </tr>
        </thead> 
        <tbody>
          @foreach($sliders as $key => $slider)
          <tr class="text-center">
            <td>{{$key + 1}}</td>
            <td class="text-left">{{$slider->name}}</td>
            <td>
              <img src="{{ asset('images/slider/') . '/' . $slider->image }}" alt="" class="responsive" width="50">
              {{-- <img src="{{ asset('images/slider/') . '/' . $slider->name . '/' . $slider->image }}" alt="" class="responsive" width="50"> --}}
            </td>
            <td>
              <a href="{{ route('admin.slider.active',$slider->id) }}" data-placement="top" title="{{ $slider->is_active == '1' ? 'Click to deactivate' : 'Click to activate' }}">
                <i class="nav-icon fas {{ $slider->is_active == '1' ? 'fa-check-circle':'fa-times-circle text-danger'}}"></i>
              </a>
            </td>
            <td>{{$slider->getUser->name}}</td>
            <td>
              <a href="{{ route('admin.slider.edit',$slider->id) }}" class="btn btn-xs btn-outline-info" title="Update"><i class="fas fa-edit"></i></a>
              <form action='javascript:void(0)' data_url="{{route('admin.slider.destroy',$slider->id)}}" method='post' class='d-inline-block'  data-placement='top' title='Permanent Delete' onclick='myFunction(this)'>
                <input type='hidden' name='_token' value='".csrf_token()."'>
                <input name='_method' type='hidden' value='DELETE'>
                <button class='btn btn-xs btn-outline-danger' type='submit' ><i class='fa fa-trash'></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>             
      </table>
    </div>
    {{-- @if ($classes->hasPages())
    <div class="card-footer">
      {!! $classes->links("pagination::bootstrap-4") !!}            
    </div>
    @endif --}}
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