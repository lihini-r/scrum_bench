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
    </style>

@endsection

<?php
//get project names
$result = DB::table('projects')->get();
$project_id_name = array();
foreach ($result as $res) {
    $project_id_name[$res->ProjectID] = $res->ProjectName;
}

//change status of sprint
$sprint_status = $sprint->status;
$update_btn_display_name = "";
if (strcmp($sprint_status, 'Not_Started') == 0) {
    $update_btn_display_name = "Start Sprint";
} else if (strcmp($sprint_status, 'Started') == 0) {
    $update_btn_display_name = "Close Sprint";
}

$story_set = array();

 //get sprint info to draw a donut chart
$est_value = \App\Http\Controllers\SprintController::getEstimatedSprintHrs($sprint->id);
$logged_values = \App\Http\Controllers\SprintController::getLoggedHours($sprint->id);
$total = ($logged_values / $est_value);
$total = round($total,1);

 //find sprint is closable to the due date
$closable_value = \App\Http\Controllers\SprintController::isSprintClosable($sprint->id);
 $date_value=\App\Http\Controllers\SprintController::isDate($sprint->id);
 
?>

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>{{ $sprint->sprint_name }}</b></h3>
                    </div>
                </div>
                <p class="lead">
                    <small>View Sprint Details below <a href="{{ route('sprints.index') }}">Back to All Sprints</a>
                    </small>
                </p>

                @if(strcmp($sprint_status,'Finished')!=0)

                    {!! Form::model($sprint, [
                                                  'method' => 'POST',
                                                  'route' => ['sprints.status', $sprint->id]  ]) !!}

                    @if(strcmp($sprint_status,'Not_Started')==0)
                        <input type="hidden" name="status" value="Started">
                        {!! Form::submit($update_btn_display_name, ['class' => 'btn btn-primary' ]) !!}
                    @endif

                    @if((strcmp($sprint_status,'Started')==0) && ($closable_value==true))
                        <input type="hidden" name="status" value="Finished">
                        {!! Form::submit($update_btn_display_name, ['class' => 'btn btn-primary' ]) !!}
                    @endif

                    @if((strcmp($sprint_status,'Started')==0) && ($closable_value==false))
                        {!! Form::submit($update_btn_display_name, ['class' => 'btn btn-primary', 'disabled' => 'disabled']) !!}
                        <br/><br/>
                        <div class="alert alert-warning">
                            <strong>The Sprint contains Un-Approved User-Stories. Please Approve all Stories to close
                                the Sprint.</strong>
                        </div>
                    @endif

                    {!! Form::close() !!}

                @endif

                <br/>
                <div class="panel panel-success">
                    <div class="panel-heading">Sprint Details</div>
                    <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">

                        <table class="table" style="border: 0;">
                            <tbody>
                            <tr>
                                <td>Project Name:</td>
                                <td>{{ $project_id_name[$sprint->project_id] }}</td>
                            </tr>
                            <tr>
                                <td>Start Date:</td>
                                <td>{{ $sprint->start_date }}</td>
                            </tr>
                            <tr>
                                <td>End Date:</td>
                                <td>{{ $sprint->end_date }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-5">
                        @if(strcmp($sprint_status,'Started')==0 && $date_value >= 3)
                            <div class="alert alert-info">
                                <strong>Only {{$date_value}} days more to complete this Sprint!!</strong>
                            </div>
                        @endif
                        @if(strcmp($sprint_status,'Started')==0 && $date_value < 3 && $date_value > 0)
                            <div class="alert alert-warning">
                                <strong>Only {{$date_value}} days more to complete this Sprint!!</strong>
                            </div>
                        @endif
                        @if(strcmp($sprint_status,'Started')==0 && $date_value < 0)
                            <div class="alert alert-danger">
                                <strong>Sprint is Overdue !!</strong>
                            </div>
                        @endif

                            @if($closable_value==true )
                                <div class="alert alert-info">
                                    <strong>This Sprint is Already Completed !</strong>
                                </div>
                            @endif
                    </div>
                </div>
                    </div>
                </div>
                <br>
                <div class="panel panel-warning">
                    <div class="panel-heading">Sprint progress</div>
                    <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">
                        <h4 style="font-weight: 900 ;color: #1CCB92">Stories in this sprint</h4>
                            <?php
                            $sprints = DB::table('sprint_schedules')->where('sprint_id', '=', $sprint->id)->get();
                            foreach ($sprints as $key => $sprint) {
                                $value = $sprint->story_id;

                                $contents = DB::table('user_stories')->where('story_id', '=', $value)->get();
                                array_push($story_set, $contents);
                            }

                            ?>

                            @foreach($story_set as $story)

                                <div class="info-box bg-green-gradient">
                                <span class="info-box-icon ">
                                <i class='glyphicon glyphicon-bookmark'> </i>
                                </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $story[0]->story_id }}</span>
                                        <span class="info-box-number">{{ $story[0]->summary }}</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 40%"></div>
                                        </div>
                                      <span class="progress-description">
                                          Estimated to {{$story[0]->org_est}} Hours
                                        </span>
                                    </div>
                                </div>
                        @endforeach


                    </div>
                    <div class="col-sm-6">
						@if($total<1)
                        <div class="wrap" style="padding:20px 50px 20px 0px;">
                            <!-- data max is the 100% point of the graph -->
                            <!-- set data-grid to 0 for no grid -->
                            <!-- data-width is the individual bars width -->
                            <div class="chartjq">
                                <div class="donut-chart" data-title="Logged Hours %" data-percent={{$total}} ></div>
                            </div>
                        </div>
						@endif
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
    <script src="{{ URL::asset('plugins/chart/jquery.chart.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.bar-chart').cssCharts({type: "bar"});
            $('.donut-chart').cssCharts({type: "donut"}).trigger('show-donut-chart');
        });
    </script>
@endsection