@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
@endsection

<?php
$result = DB::table('projects')->get();
$project_id_name = array();

foreach ($result as $res) {
    $project_id_name[$res->default . $res->ProjectID] = $res->ProjectName;
}

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

                <div class="row">
                    <div class="col-sm-6">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Sprint Name:</td>
                                <td>{{ $sprint->sprint_name }}</td>
                            </tr>
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
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-4">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
@endsection