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
											<img class="img-fluid" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg" alt="Photo">
										</div>

										
									</div>							
								</div>
							</div>				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
 <script>
        $(document).ready(function(){
           $("#in").click(function(){
                $("img").width($("img").width()+100);
                $("img").height($("img").height()+100);
           });
           $("#out").click(function(){
                $("img").width($("img").width()-100);
                $("img").height($("img").height()-100);
           });
        });
    </script> 
</section> 

@endsection