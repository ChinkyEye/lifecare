@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  
</section>
<section class="content">
     <div class="container-fluid">
      @if(session()->has('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
      @endif
      <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered table-hover m-0 w-100 table-sm">
        <thead class="bg-dark">
          <tr class="text-center">
            <th width="10">SN</th>
            <th class="text-left">Image</th>
            <th>Prescription date</th>
            <th>Address</th>
            <th>Hospital</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead> 
         <tbody>
          @foreach($query as $key => $data)
          <tr class="text-center">
            <td>{{$key+1}}</td>
            <td></td>
            <td>{{$data->epres_date}}</td>
            <td>{{$data->address}}</td>
            <td>{{$data->getHospital->name}}</td>
            <td>{{$data->getUser->name}}</td>
             <td>
           <a href="{{ route('manager.prescription.active',$data->id) }}" data-placement="top" title="{{ $data->is_active == '1' ? 'Click to deactivate' : 'Click to activate' }}">
                <i class="nav-icon fas {{ $data->is_active == '1' ? 'fa-check-circle':'fa-times-circle text-danger'}}"></i>
              </a>
            </td>
            <td>
             <a href="{{ route('manager.prescription.show', $data->id) }}" class="btn btn-xs btn-outline-info" title="view"><i class="fas fa-eye"></i></a>
            </td>
          </tr>
        @endforeach 
        </tbody>            
      </table>
    </div>
    
  </div>
</section>
@endsection

