@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet"
          href="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}">

@endsection

<?php
use \App\Http\Controllers\WorkflowController;
use \App\Http\Controllers\SprintScheduleController;
use Illuminate\Support\Facades\DB as DB;

$selected_sprint_id = $sprint_id;

//get all sprints in project
$schedule_sprints = array();
$schedule_sprints = DynUI::getSprintsInProjects();

$story_set = array();
$str="";
//foreach ($sprint_schedules as $key => $sprint_schedule) {
//
//    //$id=$sprint_schedule->sprint_id;
//    $contents = DB::table('user_stories')->where('story_id', '=', $sprint_schedule->story_id)->get();
//    array_push($story_set, $contents);
//}
//foreach($story_set as $story){
//    $str=$story[0]->story_id;
//}
//$last_status=WorkflowController::getStoryStatus($str);
//$next_action = WorkflowController::getNextActionPM($last_status);
//$next_status = WorkflowController::getNextStatePM($last_status);
$id_name_array = DynUI::getIdNameArray("sprints", "id", "sprint_name");

$id_name_array_assignee = DynUI::getIdNameArray("users", "id", "name");
$id_name_array_assignee['Not Assigned'] = "Not Assigned";

//change box status based on story status
$box_status_class = array("To-Do" => "box-danger", "In-Progress" => "box-warning", "Testing" => "box-primary", "Review" => "box-primary", "Resolved" => "box-success", "Approved" => "box-success");

?>


@section('content')
    <br/>

    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Scrum Board</b></h3>
                    </div>
                </div>
                <br/>


                <ul>
                    <!-- if condition which displays Selected sprint name if exists, (condition)?value_if_true:value_if_false -->
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                            href="#">{{ (array_key_exists($selected_sprint_id,$id_name_array))?$id_name_array[$selected_sprint_id]:"Select Sprint" }}
                            <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($schedule_sprints as $key => $schedule_sprint) {
                                $value = $id_name_array[$schedule_sprint->sprint_id];
                                $url = URL::to('sprint_schedules/sprint/' . $schedule_sprint->sprint_id);
                                echo "<li><a href='" . $url . "'>$value</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>

                <?php

                foreach ($sprint_schedules as $key => $sprint_schedule) {
                    $value = $id_name_array[$sprint_schedule->sprint_id];
                    //$id=$sprint_schedule->sprint_id;
                    $contents = DB::table('user_stories')->where('story_id', '=', $sprint_schedule->story_id)->get();
                    array_push($story_set, $contents);
                }

                ?>

                <br/>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="box box-default" style="min-height: 400px;">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">To-Do</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                @foreach($story_set as $story)
                                    <?php
                                    $dev_class = "";
                                    $last_status = WorkflowController::getStoryStatus($story[0]->story_id);
                                    $next_status = WorkflowController::getNextStatePM($last_status);
                                    ?>
                                    @if($last_status=='To-Do')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><a href="{{ URL::to('user_stories/' . $story[0]->story_id) }}">{{ $story[0]->story_id }}</a></h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
                                                <p><a href="#" data-toggle="modal" data-target="#work-flow" onclick="changeStoryId('{{$story[0]->story_id}}','{{$next_status}}')">Change Status</a></p>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    @endif
                                @endforeach
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="box box-default" style="min-height: 400px;">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">In-Progress</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                @foreach($story_set as $story)
                                    <?php
                                    $dev_class = "";
                                    $last_status = WorkflowController::getStoryStatus($story[0]->story_id);
                                    $next_status = WorkflowController::getNextStatePM($last_status);
                                    ?>
                                    @if($last_status=='In-Progress')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><a href="{{ URL::to('user_stories/' . $story[0]->story_id) }}">{{ $story[0]->story_id }}</a></h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
                                                <p><a href="#" data-toggle="modal" data-target="#work-flow" onclick="changeStoryId('{{$story[0]->story_id}}','{{$next_status}}')">Change Status</a></p>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    @endif
                                @endforeach
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="box box-default" style="min-height: 400px;">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">Testing / Review</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                @foreach($story_set as $story)
                                    <?php
                                    $dev_class = "";
                                    $last_status = WorkflowController::getStoryStatus($story[0]->story_id);
                                    $next_status = WorkflowController::getNextStatePM($last_status);
                                    ?>
                                    @if($last_status=='Testing' || $last_status=='Review')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><a href="{{ URL::to('user_stories/' . $story[0]->story_id) }}">{{ $story[0]->story_id }}</a></h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
                                                <p><a href="#" data-toggle="modal" data-target="#work-flow" onclick="changeStoryId('{{$story[0]->story_id}}','{{$next_status}}')">Change Status</a></p>

                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    @endif
                                @endforeach
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="box box-default" style="min-height: 400px;">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">Done</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                @foreach($story_set as $story)
                                    <?php
                                    $dev_class = "";
                                    $last_status = WorkflowController::getStoryStatus($story[0]->story_id);
                                    $next_status = WorkflowController::getNextStatePM($last_status);

                                    ?>
                                    @if($last_status=='Resolved' || $last_status=='Approved')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><a href="{{ URL::to('user_stories/' . $story[0]->story_id) }}">{{ $story[0]->story_id }}</a></h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
                                                @if(strcmp($last_status,"Approved")!=0)
                                                <p><a href="#" data-toggle="modal" data-target="#work-flow" onclick="changeStoryId('{{$story[0]->story_id}}','{{$next_status}}')">Change Status</a></p>
                                                @endif
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    @endif
                                @endforeach
                            </div><!-- /.box-body -->
                        </div>
                    </div>
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

                                        <div id = "next_status_lbl"></div>

                                        <input type="hidden" id="hdn_story_id" name="story_id" value="">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                        <input type="hidden" id="hdn_status" name="status" value="">

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

        </div>
    </div>

@endsection

@section('page_script1')
    <script src="{{ URL::asset('ajax/libs/jquery/1.12.0/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
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

        function changeStoryId(id, nextStatus){
            $('#hdn_story_id').val(id);
            $('#hdn_status').val(nextStatus);
            $('#next_status_lbl').html("Change Status to : " + nextStatus);
        }
    </script>
@endsection

