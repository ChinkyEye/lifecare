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
						<h3 class="profile-username text-center">{{$appointments->getAppointmentUser->name}}</h3>
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Doctor</b> <a class="float-right">{{$appointments->getDoctor->name}}</a>
							</li>
							<li class="list-group-item">
								<b>Appointment Day</b> <a class="float-right">{{$appointments->getAppointmentDay->getDayName->name}}</a>
							</li>
							<li class="list-group-item">
								<b>Appointment Time</b> <a class="float-right">{{$appointments->getAppointmentDayTime->from_time}} - {{$appointments->getAppointmentDayTime->to_time}}</a>
							</li>
						</ul>
						
					</div>
				</div>

			</div>
			
		</div>
	</div>
</section> 

@endsection