@extends('app')

<!-- START PROJECT MANAGER-->


<?php
use Illuminate\Support\Facades\DB as DB;

use App\Http\Requests;

use App\Project;

use App\AssignProjects;





if(\Auth::check() && \Auth::user()->designation === 'Project Manager') {

$user = \Auth::user()->name;

$prjman = AssignProjects::where('ProjectManager', $user)->get();

foreach ($prjman as $pj) {

	$pjt_id = $pj->ProjectName;

	$projects = Project::where('ProjectID', $pjt_id)->get();

	$projectids = DB::table('assign_teams')->where('ProjectID', $pjt_id)->get();

}

}

?>



<!-- END PROJECT MANAGER-->















<?php
use Illuminate\Support\Facades\DB as DB;
use \App\Http\Controllers\AccountController;

$accounts = DB::table('accounts')->get();


?>





@section('content')
	<br/>
	<div style="width:90%;padding:5px 5px 15px 80px;">
		<div class="panel panel-success" >




			   @if(\Auth::user()->hasRole('Super Admin'))

			<div class="panel-heading">Super Admin Dashboard</div>

			<div class="panel-body">

				<div class="panel-body">

					<table class="table table-striped table-hover">
						<thead style="background-color: #34cccd; color: white; font-size: 120%;">
						<tr>
							<td>Account ID</td>
							<td>Account Name</td>
							<td>Description</td>
							<td>Account Head</td>
							<td>Show</td>
						</tr>
						</thead>
						<tbody>
						@foreach($accounts as $key => $account)
							<tr>
								<td>{{ $account->id }}</td>
								<td>{{ $account->acc_name }}</td>
								<td>{{ $account->description }}</td>
								<td>{{ $account->acc_head }}</td>


								<!-- we will also add show, edit, and delete buttons -->
								<td>

									<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
									<!-- we will add this later since its a little more complicated than the other two buttons -->

									<!-- show the nerd (uses the show method found at GET /nerds/{id} -->

									<a class="btn btn-small btn-success" href="{{ URL::to('accounts/' . $account->id) }}">Show </a>

									<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->


								</td>
							</tr>
						@endforeach
						</tbody>
					</table>

				</div>
			</div>

		</div>
		@else
			<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">
			@endif
	</div>
	</div>
	{{--<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">--}}











<!-- START PROJECT MANAGER DASHBOARD -->




<div class="panel-heading">PROJECT MANAGER DASHBOARD</div>

	<div class="panel-body">








			<div class="box box-default" style="padding: 20px 50px 0px 20px ;">
				<div class="box-header with-border">

					<div class="panel panel-info">

						<div class="panel-heading" >

							<div class="form-group" >

								@foreach($projects as $key =>$pm)

									<h1 style="color: #00a65a" ><b>{{$pm->ProjectName}} Project</b></h1>

								@endforeach
							</div>

						</div>

					</div>

					<div class="panel panel-info">
						<div class="panel-heading"></div>

						<div class="panel-body">
							<div class="col-md-11" style="background-color: #99ee99">

								<div style="background-color: #99ee99">
									<br>
									<table class="table table-striped" style="background-color: #ddffdd">

										<tbody>





										@foreach($projects as $key =>$pro)

											<tr><td style="color: #ca195a ; font-weight: 700 ;">Account Name</td>
												<td style="color: #001a35; font-weight: 700 ;">{{ $pro->acc_name }}</td></tr>


											<tr><td style="color: #ca195a ; font-weight: 700 ;">Description</td>
												<td style="color: #001a35; font-weight: 700 ;">{{$pro->Description }}</td></tr>

											<tr><td style="color: #ca195a ; font-weight: 700 ;"> State</td>
												<td style="color: #001a35; font-weight: 700 ;">{{ $pro->State }}</td></tr>


											<tr><td style="color: #ca195a ; font-weight: 700 ;"> Duration</td>
												<td style="color: #001a35; font-weight: 700 ;">{{ $pro->duration }} months</td></tr>


										@endforeach

										</tbody>
									</table>

								</div>




							</div>
						</div>

					</div>
					<br> <br>





					<!--Display Teams-->

					<div class="panel panel-info">

						<div class="panel-heading" >

							<div class="form-group" >


								<h1 style="color: #00a65a" ><b>Assigned Teams</b></h1>


							</div>

						</div>

					</div>

					<div class="col-md-12">
						<div class="row">



							@foreach($projectids as $key =>$pids)


								<div class="col-lg-3 col-xs-6">
									<div class="small-box bg-aqua">

										<div class="inner">

											<?php

											$tid=$pids->team_id;

											$teamnames = DB::table('teams')->where('team_id', $tid)->get();

											foreach($teamnames as $tn)

												echo "<h1>$tn->TeamName</h1>";

											?>

											<h3>{{ $pids->team_id }}</h3>
										</div>


										<div class="icon">
											<i class="ion ion-person-add"></i>
										</div>
										<a class="small-box-footer" href="{{ URL::to('hide/' . $pids->team_id) }}">
											More Info..
											<i class="fa fa-arrow-circle-right"></i>
										</a>

									</div>

								</div>


							@endforeach

						</div>

					</div>

				</div>



			</div>
		</div>













	</div>
</div>
</div>








<END PROJECT MANAGER DASHBOARD-->









@endsection
