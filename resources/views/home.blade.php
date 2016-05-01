@extends('app')

<?php

//SANJANI PHP SCRIPT

use Illuminate\Support\Facades\DB as DB;
use \App\Http\Controllers\AccountController;

$accounts = DB::table('accounts')->get();





//HASINI PHP SCRIPT

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


		//LIHINI PHP SCRIPT

use \App\Http\Controllers\StoryController;
use \App\Http\Controllers\WorklogController;

$user_stories = StoryController::getAssignStories();
$result_projects = DB::table('projects')->get();
$project_id_name = array();

foreach ($result_projects as $result_project) {
	$project_id_name[$result_project->ProjectID] = $result_project->ProjectName;
}

$todo=\App\Http\Controllers\WorkflowController::getStatusCount("To-Do");
$inProgress=\App\Http\Controllers\WorkflowController::getStatusCount("In-Progress");
$approved=\App\Http\Controllers\WorkflowController::getStatusCount("Approved");
$testing=\App\Http\Controllers\WorkflowController::getStatusCount("Testing");
$resolved=\App\Http\Controllers\WorkflowController::getStatusCount("Resolved");
$accept_major=StoryController::getPriority("major");
$accept_minor=StoryController::getPriority("minor");
$accept_blocker=StoryController::getPriority("blocker");



?>



@section('page_styles')
	<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/chart/cssCharts.css') }}">

	<style>
		/* START DEVELOPER DASHBOARD - page specific styles */
		hr {
			width: 60%;
			height: 1px;
			background: none;
			border: none;
			border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
			outline: none;
			margin: 40px auto 60px auto;
		}

		.desc p {
			text-align: center;
			font-size: 16px;
			color: rgba(0, 0, 0, 0.6);
			padding: 20px 0 0 0;
			font-family: sans-serif;
		}

		.desc a {
			color: blue;
		}

		.wrap {
			margin: 0 auto;
			width: 640px;
			padding-bottom: 100px;
		}

		#line {
			width: 400px;
		}

		/* page specific styles*/

		.icon-success {
			color: red;
		}
		.icon-successes {
			color: #0306ff;
		}

		#inner {
			width: 50%;
			margin: 0 auto;
		}
		.icon-success1{
			color: #09ff00;
		}
		.icon-success2{
			color: #fff906;
		}
		.icon-success3{
			color: #ff3560;
		}
		.icon-success5{
			color: #0eb6ff;
		}
		.icon-success4{
			color: #ff752a;
		}
		.bg-red {
			background-color: #34a2a2 !important;
		}
		.box.box-solid.box-danger {
			border: 1px solid #347e79;
		}
		.box.box-solid.box-danger > .box-header {
			color: #fff;
			background: #5d2b25;
			background-color: #377175;
		}
		/* END DEVELOPER DASHBOARD - page specific styles */
	</style>
@endsection


{{--Danushka page styles--}}

<style>
	.text-width
	{
		width: 50%;
	}
</style>




@section('content')


	{{--START SUPERADMIN DASHBOARD --}}

	@if(\Auth::user()->can('view_super_admin_dashboard'))

		<br/>
		<div class="container" style="width: 100%" >
			<div class="box box-default" style="padding: 20px 50px 0px 20px;">

				<div class="box-header with-border">
					<div style="width:130%;padding:5px 5px 15px 10px;">
						<div class="panel panel-info" style="width: 80%">
							<div class="panel-heading"><h1> My Dashboard</h1></div>

							<div class="panel-body">

								<div class="panel-body" style="margin-left: 1%">



									@foreach($accounts as $key => $account)
										@if($account->Hide==="off")
											<div class="col-lg-6 col-xs-10" >
												<div class="small-box bg-aqua">
													<div class="inner">

														<h4>{{ $account->acc_name }}</h4>

														<p>Account Head : {{ $account->acc_head }}</p>

														<a class="btn btn-small btn-success"  href="{{ URL::to('superadmindashboards/' . $account->id) }}" >
															More Info..
															<i class="fa fa-arrow-circle-right"></i>
														</a>

													</div></div></div>
										@endif
									@endforeach


								</div></div></div></div></div></div></div>

		{{--END SUPERADMIN DASHBOARD --}}

	@elseif(\Auth::user()->can('view_acchead_dashboard'))

		{{--START ACCOUNHEAD DASHBOARD--}}





		<div class="container">
			<h1>Account Head Dashboard</h1>
			<br>
			<?php  $count=1 ?>

					<!--get all project -->
			@foreach($projects as $key => $project)
				@if($count%4==0)
					<div class="container" style="position:absolute;left:650px;top: 200px">
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">
								<div class="small-box bg-red" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>
									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endif

				@if($count%5==0)
					<div class="container" style="position:absolute;left:650px;top: 340px">
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">
								<div class="small-box bg-yellow" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>

									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endif

				@if($count%6==0)
					<div class="container" style="position:absolute;left:650px;top: 480px">
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">

								<div class="small-box bg-aqua" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>
									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endif

				@if($count%7==0)
					<div class="container" style="position:absolute;left:1000px;top: 200px">
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>
									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endif


				@if($count==1)
					<div class="container"  style="position:absolute;top:200px;">
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-aqua" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>
									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				@endif

				@if($count==3)
					<div class="container" style="position:absolute;left:245px;top: 480px" >
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-red" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>
									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>

							</div>
						</div>
					</div>
				@endif

				@if($count==2)
					<div class="container" style="position:absolute;left:245px;top: 340px">
						<div class="col-md-12">
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green" >
									<div class="inner">
										<h4><b>{{ $project->ProjectName }}</b></h4>
										<p>Project ID: {{ $project->ProjectID }}</p>
									</div>
									<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>

							</div>
						</div>
					</div>
				@endif

				<?php
				$count=$count+1
				?>
			@endforeach
		</div>







{{--END ACCOUNTHEAD DASHBOARD--}}







	@elseif(\Auth::user()->can('view_pm_dashboard'))

		{{--START PROJECT MANAGER DASHBOARD--}}

@section('content')
	<br/>

	<div class="container">


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

@endsection


{{--END PROJECT MANAGER DASHBOARD--}}










	@elseif(\Auth::user()->can('view_devdashboard'))

		{{--START DEVELOPER DASHBOARD--}}


		<br/>
		<div class="container">

			<!-- START DEVELOPER DASHBOARD - HTML - INSIDE CONTENT SECTION -->
			<div style="width:97%;padding:5px 5px 15px 15px;">
				@if($user_stories!=null)
					<div class="panel panel-info">
						<div class="panel-heading" style="font-weight: 900 ;color: rgba(45, 18, 132, 0.94)">Developer Dashboard</div>
						<div class="panel-body">
							<h4 style="font-weight: 900 ;color: #0a0d14">Stories Assigned to me</h4>
							<table class="table table-striped table-hover">
								<thead style="background-color: #34cccd; color: white; font-size: 120%;">
								<tr style="font-weight: 900 ;color: #eff7ff">
									<td>Story ID</td>
									<td>Project Name</td>
									<td>Task</td>
									<td>Progress</td>
								</tr>
								</thead>
								<tbody>
								@foreach($user_stories as $key => $user_story)
									<tr>
										<td><a href="{{ URL::to('user_stories/' . $user_story->story_id) }}">{{ $user_story->story_id }}</a></td>
										<td>{{ $project_id_name[$user_story->project_id] }}</td>
										<td>{{ $user_story->summary }}</td>
										<td><?php
											$logged_hrs = WorklogController::getTotalLoggedHours($user_story->story_id);
											$est_hrs = intval($user_story->org_est);
											echo DynUI::getProgressMarkup($est_hrs, $logged_hrs);
											?></td>
									</tr>
								@endforeach
								</tbody>
							</table>
							<br/>
							<br/>

							<div class="row">
								<div class="col-sm-6">
									<div class="box box-default" style="min-height: 570px; padding:5px 5px 20px 20px;">
										<br/>
										<h4 style="font-weight: 900 ;color: #2d1284">Stories Based on Priority</h4>
										<br/>
										<div id="inner">
											<div class="chartjq">
												<div class="pie-thychart" data-set='[["To Do", {{$todo}}], ["In Progress",{{$inProgress}}], ["Approved",{{$approved}}]]' data-colors="#FBE4DB,#F17F49,#BD380F"></div>
											</div>
										</div>
										<br/>
										<table class="table table-striped table-hover" width="70%">
											<thead style="background-color: #95cd2a; color: white; font-weight: 900 ;">
											<tr>
												<td>Priority</td>
												<td>Count</td>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td><span class="glyphicon glyphicon-arrow-up icon-success"></span>&nbsp;&nbsp;Major</td>
												<td>{{ $accept_major}}</td>
											</tr>
											<tr>
												<td><span class="glyphicon glyphicon-arrow-down icon-successes"></span>&nbsp;&nbsp;Minor</td>
												<td>{{ $accept_minor}}</td>
											</tr>
											<tr>
												<td><span class="glyphicon glyphicon-ban-circle icon-success"></span>&nbsp;&nbsp;Blocker</td>
												<td>{{ $accept_blocker}}</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="box box-default" style="min-height: 570px; padding:5px 5px 20px 20px;">
										<br/>
										<h4 style="font-weight: 900 ;color: #2d1284">Stories Based on Status</h4>
										<br/>
										<div id="inner">
											<div class="chartjq">
												<div class="pie-thychart2" data-set='[["Major", {{$accept_major}}], ["Minor",{{$accept_minor}}], ["Blocker",{{$accept_blocker}}]]' data-colors="#FBE4DB,#F17F49,#BD380F"></div>
											</div>
										</div>
										<br/>
										<table class="table table-striped table-hover" width="70%">
											<thead style="background-color: #cd69a8; color: white; font-weight: 900 ;">
											<tr>
												<td>Status</td>
												<td>Count</td>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td><span class="glyphicon glyphicon-info-sign icon-success1"></span>&nbsp;&nbsp;To-Do</td>
												<td>{{ $todo}}</td>
											</tr>
											<tr>
												<td><span class="glyphicon glyphicon-info-sign icon-success2"></span>&nbsp;&nbsp;In-Progress</td>
												<td>{{$inProgress}}</td>
											</tr>
											<tr>
												<td><span class="glyphicon glyphicon-info-sign icon-success3"></span>&nbsp;&nbsp;Testing</td>
												<td>{{$testing}}</td>
											</tr>
											<tr>
												<td><span class="glyphicon glyphicon-info-sign icon-success5"></span>&nbsp;&nbsp;Resolved</td>
												<td>{{$resolved}}</td>
											</tr>
											<tr>
												<td><span class="glyphicon glyphicon-info-sign icon-success4"></span>&nbsp;&nbsp;Approved</td>
												<td>{{$approved}}</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<br/>
							<br/>

							<div class="col-sm-12" >
								<br/>
								<div class="box box-default" style="min-height: 400px;">
									<div class="box-body">
										<div class="box box-danger box-solid">
											<div class="box-header with-border">
												<h4 class="box-title" style="font-weight: 900 ;color: #eff7ff">Remaining Days For Each User Story</h4>
												<div class="box-tools pull-right">
													<button class="btn btn-box-tool" data-widget="collapse"><i
																class="fa fa-minus"></i></button>
												</div><!-- /.box-tools -->
											</div><!-- /.box-header -->

											@foreach($user_stories as $key => $user_story)
												<?php
												$date_value=\App\Http\Controllers\StoryController::isDueDateOfStory($user_story->story_id);
												?>
												<div style="display: block ;" class="box-body">
													<div class="info-box bg-red">
														<span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
														<div class="info-box-content">
															<span class="info-box-text" ><a href="{{ URL::to('user_stories/' . $user_story->story_id) }}" style="color: #FFFFFF;">{{ $user_story->story_id }}</a></span>
                                                                <span class="info-box-number">
                                                                @if($date_value < 3 && $date_value > 0)
																		Only {{$date_value}} days more to complete this user story!!
																	@endif
																	@if($date_value < 0)
																		<h4>Story is Overdue</h4>
																	@endif
                                                                </span>
														</div><!-- /.info-box-content -->
													</div><!-- /.info-box -->
												</div><!-- /.box-body -->
											@endforeach

										</div><!-- /.box -->
									</div><!-- /.box-body -->
								</div>
							</div>


						</div>
					</div>
				@endif
			</div>
			<!-- END DEVELOPER DASHBOARD - HTML - INSIDE CONTENT SECTION -->

		</div>






		{{--END DEVELOPER DASHBOARD--}}


    @else
		<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">
	@endif

@endsection

{{--//LIHINI PAGE SCRIPTS--}}
	@section('page_script1')
			<!-- START DEVELOPER DASHBOARD - JAVASCRIPT - INSIDE page_script1 SECTION -->
		<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
		<script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
		<script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
		<!-- END DEVELOPER DASHBOARD - JAVASCRIPT - INSIDE page_script1 SECTION -->
		@endsection

		@section('page_script2')
				<!-- START DEVELOPER DASHBOARD - JAVASCRIPT - INSIDE page_script2 SECTION -->
		<script src="{{ URL::asset('plugins/chart/jquery.chart.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('.bar-chart').cssCharts({type: "bar"});
				$('.donut-chart').cssCharts({type: "donut"}).trigger('show-donut-chart');
				$('.pie-thychart').cssCharts({type:"pie"});
				$('.pie-thychart2').cssCharts({type:"pie"});
			});
		</script>
		@endsection