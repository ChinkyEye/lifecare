@extends('manager.main.main')
@section('content')
<?php $page = substr((Route::currentRouteName()), 8, strpos(str_replace('manager.','',Route::currentRouteName()), ".")); ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg" alt="User profile picture">
						</div>
						<h3 class="profile-username text-center">{{$prescriptions->getUser->name}}</h3>
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Address</b> <a class="float-right">{{$prescriptions->address}}</a>
							</li>
							<li class="list-group-item">
								<b>Hospital Name</b> <a class="float-right">{{$prescriptions->getHospital->name}}</a>
							</li>
							<li class="list-group-item">
								<b>Phone Number</b> <a class="float-right">{{$prescriptions->getUser->phone}}</a>
							</li>
						</ul>
						
					</div>
				</div>
			<div class="card card-primary">
				<div class="card-body">
					<strong><i class="far fa-file-alt mr-1"></i>Remarks</strong>
					<p class="text-muted">{{$prescriptions->remarks}}</p>
				</div>
	</div>
	</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="tab-content">
							<div class="active tab-pane" id="activity">
								<div class="post">
									<div class="user-block">
										<h4>Prescription</h4>				
									</div>
									<div class="row mb-3">
										<div class="col-sm-12">
											<img class="img-fluid" id="panzoom" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg" alt="Photo">
										</div>
									</div>	
									<div class="row mb-3">
										<input type="range" class="zoom-range w-100">
          <button class="zoom-in btn btn-block btn-outline-info">Zoom In</button>
          <button class="zoom-out btn btn-block btn-outline-info">Zoom Out</button>
          <button class="reset btn btn-block btn-outline-danger">Reset</button>
									</div>						
								</div>
							</div>				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.panzoom/2.0.6/jquery.panzoom.min.js"></script>
  <script type="text/javascript">
    $("#panzoom").panzoom({
      $zoomIn: $(".zoom-in"),
      $zoomOut: $(".zoom-out"),
      $zoomRange: $(".zoom-range"),
      $reset: $(".reset"),
      contain: 'invert',
    });
  </script>
@endpush