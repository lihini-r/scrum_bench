@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <?php
    use Illuminate\Support\Facades\DB as DB;
    use \App\Http\Controllers\WorkflowController;
    use \App\Http\Controllers\WorklogController;

    $id = Auth::user()->designation;

    //find the project name according to the given project id
    $result_projects = DB::table('projects')->get();
    $project_id_name = array();

    foreach ($result_projects as $result_project) {
        $project_id_name[$result_project->ProjectID] = $result_project->ProjectName;
    }


    //find the name of the user according to the designation
    $result_developers = DB::table('users')->where('designation', '=', 'Developer')->get();
    $dev_id_name = array();

    foreach ($result_developers as $result_developer) {
        $dev_name = $result_developer->name;
        $dev_id = $result_developer->id;

        $dev_id_name[$result_developer->id] = $result_developer->name;


    }
    $dev_id_name['Not Assigned'] = "Unassigned";

    //get last status of user story to update the next status and next action
    $last_status=WorkflowController::getStoryStatus($user_story->story_id);

    //get total logged hours and estimated hours to draw progress bar
    $logged_hrs = WorklogController::getTotalLoggedHours($user_story->story_id);
    $est_hrs = intval($user_story->org_est);

    //find remaining days for each user story
    $date_value=\App\Http\Controllers\StoryController::isDueDateOfStory($user_story->story_id);
    //echo "-----------------------------------------".$date_value;

    $progress_value=\App\Http\Controllers\StoryController::progressbar($user_story->story_id,$user_story->org_est);

    $timeIndicator =\App\Helpers\TimeIndicatorFactory::create("Total",$user_story->story_id,$user_story->org_est);
    $new_progress_value = $timeIndicator->getMarkup();

    $timeIndicatorR =\App\Helpers\TimeIndicatorFactory::create("Remaining",$user_story->story_id,$user_story->org_est);
    $new_progress_remaining_value = $timeIndicatorR->getMarkup();

    $timeIndicatorL =\App\Helpers\TimeIndicatorFactory::create("Logged",$user_story->story_id,$user_story->org_est);
    $new_progress_logged_value = $timeIndicatorL->getMarkup();


    ?>

@endsection
<?php
$results = DB::table('users')->get();
$dateNoe=date("Y-m-d");
?>

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">

                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>User Story {{ $user_story->story_id }}</b></h3>
                    </div>
                </div>

                <ul class="nav nav-pills">
                    <li role="presentation" style="font-weight: 900 ;color: rgba(10, 13, 20, 0.95)"><a href="#" data-toggle="modal" data-target="#work-log">Work Log</a></li>
                    @if($id=="Developer" )
                        <?php
                        $next_action = WorkflowController::getNextActionPM($last_status);
                        $next_status = WorkflowController::getNextStatePM($last_status);
                        ?>
                            @if($next_status!="Approved")
                    <li role="presentation" style="font-weight: 900 ;color: rgba(10, 13, 20, 0.95)"><a href="#" data-toggle="modal"
                                               data-target="#work-flow" <?php echo ($last_status == "Resolved") ? "style='pointer-events: none; cursor: default; color:red'" : "" ?> >{{$next_action}}</a>
                    </li>
                            @endif
                    @endif

                    @if($id=="Project Manager")
                        <?php
                        $next_action = WorkflowController::getNextActionPM($last_status);
                        $next_status = WorkflowController::getNextStatePM($last_status);
                        ?>
                    <li role="presentation" style="font-weight: 900 ;color: rgba(10, 13, 20, 0.95)"><a href="#" data-toggle="modal"
                                               data-target="#work-flow" <?php echo ($last_status == "Approved") ? "style='pointer-events: none; cursor: default; color:red'" : "" ?>>{{$next_action}}</a>
                    </li>
                    @endif
                    <li role="presentation" style="font-weight: 900 ;color: rgba(10, 13, 20, 0.95)"><a
                                href="{{ url('/worklogs?story_id='.$user_story->story_id) }}">History</a></li>
                    <li style=" padding:0px 10px 0px 20px; font-weight: 900 ; color: #5382CE" class="pull-right"><a
                                href="{{ route('user_stories.index') }}">Back to Backlog</a></li>

                </ul>

                @if($date_value < 3 && $date_value > 0)
                    <div class="alert alert-warning">
                        <strong>Only {{$date_value}} days more to complete this user story!!</strong>
                    </div>
                @endif
                @if($date_value < 0)
                    <div class="alert alert-danger">
                        <strong>Story is Overdue !!</strong>
                    </div>
                @endif

                {{--<div class="form-group" style="padding:20px 10px 20px 20px;">--}}
                    {{--<a class="btn btn-small btn-info pull-right"--}}
                       {{--href="{{ url('/worklogs?story_id='.$user_story->story_id) }}">View My Work Logs</a>--}}
                {{--</div>--}}

                <br/><br/>

                <div class="row">
                    <div class="col-sm-6">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Project</td>
                                <td>{{ $project_id_name[$user_story->project_id] }}</td>
                            </tr>
                            <tr>
                                <td>Task</td>
                                <td>{{ $user_story->summary }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $user_story->description }}</td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>{{ $user_story->priority }}</td>
                            </tr>
                            <tr>
                                <td>Original Estimate</td>
                                <td>{{ $user_story->org_est }}</td>
                            </tr>
                            <tr>
                                <td>Due Date</td>
                                <td>{{ $user_story->due_date }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-4">
                        <table class="table pull-right">
                            <tbody>
                            @if(DynUI::isUserRole("Project Manager")  || DynUI::isUserRole("Account Head"))
                                <tr>
                                    <td><a href="#" data-toggle="modal" data-target="#assign-me">assignee</a></td>
                                    <td>{{ $dev_id_name[$user_story->assignee] }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Reporter</td>
                                <td>{{ $user_story->reporter }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="label label-warning">{{ $last_status }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Total : <?php echo $new_progress_value ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                   Logged :  <?php echo $new_progress_logged_value ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Remaining : <?php echo $new_progress_remaining_value ?>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


                <!--work flow Modal -->
                <div id="work-flow" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">UPDATE STORY STATUS</h4>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            {!! Form::open(['route' => 'workflows.store']) !!}
                                            <p>Change Status to {{ $next_status }} </p>

                                            <input type="hidden" name="story_id" value="{{$user_story->story_id}}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">

                                            <input type="hidden" name="status" value="{{$next_status}}">

                                            Date

                                            <div class="form-group">
                                                <div class='input-group date' id='work_flow_start' style="width: 50%;">
                                                    <input type='text' class="form-control" name="updated_date"
                                                           readonly/>
                                               <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                {!! Form::submit('Update Status', ['class' => 'btn btn-primary' ]) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>

                        </div>

                    </div>
                </div>


                <!--Work Log Modal -->
                <div id="work-log" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Log Your Work</h4>
                            </div>
                            <div class="modal-body">


                                @if(strcmp(Session::get($user_story->story_id.'-'.Auth::user()->id),'started')!=0)
                                    {!! Form::open(['route' => 'worklogs.store']) !!}
                                    Start Date
                                    <!--<input id="work_start" class="form-control" name="work_start_date" type="text"
                                           style="width: 50%;"/>-->
                                    <div class="form-group">
                                        <div class='input-group date' id='work_start' style="width: 50%;">
                                            <input type='text' class="form-control" name="work_start_date" readonly/>
                                               <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="description" value="STARTED">
                                    <input type="hidden" name="story_id" value="{{$user_story->story_id}}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                    <div class="modal-footer">
                                        {!! Form::submit('Start Work Log', ['class' => 'btn btn-primary' ,'id' => 'start-btn' ]) !!}
                                        {!! Form::close() !!}
                                    </div>

                                @endif
                                @if(strcmp(Session::get($user_story->story_id.'-'.Auth::user()->id),'started')==0)
                                    {!! Form::model(new \App\Worklog(), [
                                        'method' => 'PATCH',
                                        'route' => ['worklogs.update', Session::get($user_story->story_id.'-'.Auth::user()->id."-id")]
                                    ,'role' => 'form' , 'data-toggle' => 'validator' ]) !!}
                                    Description
                                    <div class="form-group">
                                    <textarea class="form-control" placeholder="Enter ..." rows="3" name="description"
                                              style="width: 100%;"
                                              tabindex="2" id="desc-txt" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    End Date

                                    <div class="form-group">
                                        <div class='input-group date' id='work_end' style="width: 50%;">
                                            <input type='text' class="form-control" name="work_end_date"/>
                                               <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="story_id" value="{{$user_story->story_id}}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                    <div class="modal-footer">
                                        {!! Form::submit('End Work Log', ['class' => 'btn btn-primary' ,'id' => 'end-btn' ]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>

                <!--Assign to me Modal -->
                <div id="assign-me" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Story Assignment</h4>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="box box-default">
                                        <div class="box-header with-border">

                                            {!! Form::model($user_story, [
                                              'method' => 'POST',
                                              'route' => ['user_stories.assign', $user_story->story_id]        ]) !!}
                                            <p>Select developer</p>


                                            <select class="form-control select2 select2-hidden-accessible"
                                                    name="assignee" style="width: 50%;"
                                                    tabindex="-1"
                                                    aria-hidden="true">

                                                <?php
                                                foreach ($result_developers as $result_developer) {
                                                    $dev_name = $result_developer->name;
                                                    $dev_id = $result_developer->id;
                                                    $dev_id_name[$result_developer->id] = $result_developer->name;
                                                    echo "<option value = '$dev_id' >$dev_name</option >";
                                                }
                                                ?>


                                            </select>

                                            <div class="modal-footer">
                                                {!! Form::submit('Assign User Story', ['class' => 'btn btn-primary' ]) !!}
                                                {!! Form::close() !!}
                                            </div>

                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>

                    </div>
                </div>

                @if($errors->any())
                    <script>
                        $(function () {
                            $('#result-model-title').html('Error');
                            $('#result-modal').modal('show');
                        });
                    </script>
                @endif
                @if(Session::has('flash_message'))
                    <script>
                        $(function () {
                            $('#result-model-title').html('Message');
                            $('#result-modal').modal('show');
                        });
                    </script>
                    @endif


                            <!--Result Modal -->
                    <div id="result-modal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        <div id="result-model-title">Message</div>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>

                        </div>
                    </div>


            </div>
        </div>
    </div>
@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
@endsection

@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var dateNow = new Date();
            $('#work_start').datetimepicker({

                viewMode: 'years',
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
        });
        $(function () {
            var dateNow = new Date();
            $('#work_end').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
        });

        $(function () {
            var dateNow = new Date();
            $('#work_flow_start').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                defaultDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
        });
    </script>
@endsection

