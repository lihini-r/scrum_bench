@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
@endsection

<?php
use \App\Http\Controllers\WorkflowController;
use \App\Http\Controllers\SprintScheduleController;

use Illuminate\Support\Facades\DB as DB;

$story_set = array();
$id_name_array = DynUI::getIdNameArray("sprints", "id", "sprint_name");

$id_name_array_assignee = DynUI::getIdNameArray("users", "id", "name");
$id_name_array_assignee['Not Assigned'] = "Not Assigned";

$box_status_class = array("To-Do" => "box-danger", "In-Progress" => "box-warning", "Testing" => "box-primary", "Review" => "box-primary", "Resolved" => "box-success", "Closed" => "box-success");

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
                <div class="scrollable_div">
                    <div class="form-group">
                        Latest Sprint<select class="form-control select2 select2-hidden-accessible" name="sprint_id"
                                             style="width: 50%;"
                                             tabindex="-1"
                                             aria-hidden="true">
                            <?php
                            foreach ($sprint_schedules as $key => $sprint_schedule) {
                                $value = $id_name_array[$sprint_schedule->sprint_id];

                                $contents = DB::table('user_stories')->where('story_id', '=', $sprint_schedule->story_id)->get();
                                array_push($story_set, $contents);

                            }
                            echo "<option value = '$value' >$value</option >";
                            ?>

                        </select>
                    </div>

                </div>
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
                                    ?>
                                    @if($last_status=='To-Do')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">{{ $story[0]->story_id }}</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
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
                                    ?>
                                    @if($last_status=='In-Progress')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">{{ $story[0]->story_id }}</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
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
                                    ?>
                                    @if($last_status=='Testing' || $last_status=='Review')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">{{ $story[0]->story_id }}</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
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
                                    ?>
                                    @if($last_status=='Resolved' || $last_status=='Closed')
                                        <div class="box {{ $box_status_class[$last_status] }} box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">{{ $story[0]->story_id }}</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                                class="fa fa-minus"></i></button>
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div style="display: block;" class="box-body">
                                                Summary : {{ $story[0]->summary }}<br>
                                                Assignee : {{ $id_name_array_assignee[$story[0]->assignee] }}<br>
                                                Priority : {{ $story[0]->priority }}
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    @endif
                                @endforeach
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

