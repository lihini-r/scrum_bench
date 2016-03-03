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
                        <h3><b>Sprints</b></h3>
                    </div>
                </div>
                <div class="form-group" style="padding:0px 10px 0px 20px;">
                    @if(DynUI::isUserRole("Project Manager") || DynUI::isUserRole("Account Head"))
                        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('sprints/create') }}">Create New
                            Sprint</a>
                    @endif
                </div>
                <br/><br/><br/>

                <div class="scrollable_div">
                    <table class="table table-striped table-bordered scrollable_div">
                        <thead style="background-color: #cdc1c5">
                        <tr>

                            <td>Sprint Name</td>
                            <td>Project Name</td>

                            <td>Show/Edit</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sprints as $key => $sprint)
                            <tr>

                                <td>{{ $sprint->sprint_name }}</td>
                                <td>{{ $project_id_name[$sprint->project_id] }}</td>


                                <!-- we will also add show, edit, and delete buttons -->
                                <td>
                                    <a class="btn btn-small btn-success"  href="{{ URL::to('sprints/' . $sprint->id) }}">Show</a>
                                    @if(DynUI::isUserRole("Project Manager")  || DynUI::isUserRole("Account Head"))
                                        <a class="btn btn-small btn-info"
                                           href="{{ URL::to('sprints/' . $sprint->id . '/edit') }}">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection