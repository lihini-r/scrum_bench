@extends('app')
<?php
use Illuminate\Support\Facades\DB as DB;
use \App\Http\Controllers\AccountController;
use \App\Http\Controllers\StoryController;
use \App\Http\Controllers\WorklogController;
$accounts = DB::table('accounts')->get();
$user_stories = StoryController::getAssignStories();
$result_projects = DB::table('projects')->get();
$project_id_name = array();

foreach ($result_projects as $result_project) {
    $project_id_name[$result_project->default . $result_project->ProjectID] = $result_project->ProjectName;
}

?>

@section('content')
	<br/>
    <div class="container">
	<div style="width:80%;padding:5px 5px 15px 80px;">
		<div class="panel panel-success" >
			<div class="panel-heading">Home</div>
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
		
		<h1>Account Head Dashboard</h1>
		<br>

		<?php $c= count(DB::table("projects"));?>
			@foreach($projects as $key => $project)
			<?php $c=$c+1?>

			<div class="container" style="position: relative;left: auto">
				<div class="col-md-12">
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<table>
								<tr>
									<div class="small-box bg-aqua" >
										<div class="inner">
											<h4><b>{{ $project->ProjectName }}</b></h4>
											<p>{{ $project->ProjectID }}</p>
										</div>
										<a href="{{ URL::to('projects/' . $project->ProjectID) }}" class="small-box-footer">
												More info <i class="fa fa-arrow-circle-right"></i>
										</a>
									</div>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<!-- we will also add show, edit, and delete buttons -->
			</div>
			@endforeach
		<?php echo $c?>		
	</div>
	<div style="width:95%;padding:5px 5px 15px 15px;">
            @if($user_stories!=null)
                <div class="panel panel-info">
                    <div class="panel-heading">Developer Dashboard</div>

                    <div class="panel-body">

                        <table class="table table-striped table-hover">
                            <thead style="background-color: #34cccd; color: white; font-size: 120%;">
                            <tr>
                                <td>Story ID</td>
                                <td>Project Name</td>
                                <td>Task</td>
                                <td>Progress</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_stories as $key => $user_story)
                                <tr>
                                    <td>{{ $user_story->story_id }}</td>
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

                    </div>
                </div>
            @endif
        </div>
	
</div>
	{{--<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">--}}
@endsection
