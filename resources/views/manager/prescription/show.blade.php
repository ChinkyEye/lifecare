@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content-header"></section>
<section class="content">

        @foreach($prescriptions as $prescription)
           
      {{$prescription->id}} 
          
    
        
          

@endforeach

</section>
@endsection