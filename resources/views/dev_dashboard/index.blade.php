@extends('app')
@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/chart/cssCharts.css') }}">

    <style>
        /* page specific styles*/
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

    </style>
@endsection
<?php
use Illuminate\Support\Facades\DB as DB;
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
@section('content')

    <br/>
    <div class="container">
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
    </div>
@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
@endsection

@section('page_script2')
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