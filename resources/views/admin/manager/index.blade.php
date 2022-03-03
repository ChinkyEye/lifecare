@extends('admin.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header"></section>
<section class="content">
  <a href="{{ route('admin.manager.create')}}" class="btn btn-sm btn-info text-capitalize rounded-0">Add {{ $page }} </a>
  <div class="card">
    {{-- <div class="card-header">
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="{{request()->url()}}" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div> --}}
    <div class="table-responsive">
      <table class="table table-bordered table-hover m-0 w-100 table-sm">
        <thead class="bg-dark">
          <tr class="text-center">
            <th width="10">SN</th>
            <th class="text-left">Name</th>
            <th width="10">Status</th>
            <th width="150">Created By</th>
            <th width="100">Action</th>
          </tr>
        </thead> 
        <tbody>
          @foreach($users as $key => $user)
          <tr class="text-center">
            <td>{{$key + 1}}</td>
            <td class="text-left">{{$user->name}}</td>
            <td>
              <a href="{{ route('admin.manager.active',$user->id) }}"data-placement="top" title="{{ $user->is_active == '1' ? 'Click to deactivate' : 'Click to activate' }}">
                <i class="nav-icon fas {{ $user->is_active == '1' ? 'fa-check-circle':'fa-times-circle text-danger'}}"></i>
              </a>
            </td>
            <td>{{$user->getUser->name}}</td>
            <td>
              <a href="{{ route('admin.manager.edit',$user->id) }}" class="btn btn-xs btn-outline-info" title="Update"><i class="fas fa-edit"></i></a>
              {{-- <form action="{{ route('admin.manager.destroy',$user->id) }}" method="post" class="d-inline-block delete-confirm" title="Permanent Delete">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-xs btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
              </form> --}}
              <form action='javascript:void(0)' data_url="{{route('admin.manager.destroy',$user->id)}}" method='post' class='d-inline-block'  data-placement='top' title='Permanent Delete' onclick='myFunction(this)'>
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