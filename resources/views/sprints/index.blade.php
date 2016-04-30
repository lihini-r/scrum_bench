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

//draw bar chart using sprint array
$bar_chart=\App\Http\Controllers\SprintController::getAllSprintsBarChartData($sprints);

?>


@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Sprints</b></h3>
                    </div>
                </div>
                <div class="form-group" style="padding:0px 10px 0px 20px;">
                    @if(DynUI::isUserRole("Project Manager") || DynUI::isUserRole("Account Head"))
                        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('sprints/create') }}"> <i class='glyphicon glyphicon-plus'> </i>Create New
                            Sprint</a>
                    @endif
                </div>
                <br/><br/><br/>

                <div class="scrollable_div" style="background-color: #7adddd">
                    <table class="table table-striped table-bordered scrollable_div">
                        <thead style="background-color: #3c8dbc">
                        <tr style="font-weight: 900 ;color: #eff7ff">
                            <td>Sprint Name</td>
                            <td>Project Name</td>
                            <td>Status</td>
                            <td>Show/Edit/Delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sprints as $key => $sprint)
                            <tr>

                                <td>{{ $sprint->sprint_name }}</td>
                                <td>{{ $project_id_name[$sprint->project_id] }}</td>

                                <td>

                                    <span <?php echo ($sprint->status == "Not_Started") ? "class='label label-danger'" : "class='label label-warning'"; ?> >{{ $sprint->status }}</span>
                                </td>
                                <!-- we will also add show, edit, and delete buttons -->
                                <td>
                                    {!! Form::model( $sprint, [ 'method' => 'DELETE', 'route' => ['sprints.destroy',$sprint->id], 'id' => 'sprint-del-frm' ]) !!}

                                    <a class="btn btn-small btn-info" style="background-color: #5b9909" href="{{ URL::to('sprints/' . $sprint->id) }}"><i class='glyphicon glyphicon-eye-open'></i>Show</a>
                                    @if(DynUI::isUserRole("Project Manager")  || DynUI::isUserRole("Account Head"))
                                        <a class="btn btn-small btn-info" style="background-color: #005384"
                                           href="{{ URL::to('sprints/' . $sprint->id . '/edit') }}"><i class='glyphicon glyphicon-edit'> </i>Edit</a>

                                        <a title="" data-original-title="" class="btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i> Delete</a>
                                    @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <h4 style="font-weight: 900 ;color: #2d1284">Sprint velocity chart</h4>
                <br>
                <br>
                <div class="wrap">
                    <div class="chartjq">
                        <ul class="bar-chart" data-bars="{{$bar_chart}}" data-max="10"
                            data-unit="h"
                            data-width="24"></ul>
                    </div>
                    <!-- data max is the 100% point of the graph -->
                    <!-- set data-grid to 0 for no grid -->
                    <!-- data-width is the individual bars width -->
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
    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.bar-chart').cssCharts({type: "bar"});

            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#sprint-del-frm').submit();
                }
            });
        });
    </script>
@endsection