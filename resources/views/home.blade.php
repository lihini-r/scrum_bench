@extends('app')













<?php
//use Illuminate\Support\Facades\DB as DB;
use \App\Http\Controllers\AccountController;

$accounts = DB::table('accounts')->get();


?>





@section('content')
<!--START ACOUNTHEAD DASHBOARD-->
@if( Auth::user()->designation=='Account Head')
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

	<!--<br/>
<div style="width:80%;padding:5px 5px 15px 80px;">
<div class="panel panel-success" >
	<div class="panel-heading">Home</div>

	<div class="panel-body">
		You are logged in!
	</div>
</div>
</div>
<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">-->
	@endif
<!--END ACOUNTHEAD DASHBOARD-->





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













@endsection
