@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
@endsection

<?php
$result = DB::table('projects')->get();
$project_id_name = array();

foreach ($result as $res) {
    $project_id_name[$res->ProjectID] = $res->ProjectName;
}

$sprint_status = $sprint->status;

$update_btn_display_name = "";
if (strcmp($sprint_status, 'Not_Started') == 0) {
    $update_btn_display_name = "Start Sprint";
} else if (strcmp($sprint_status, 'Started') == 0) {
    $update_btn_display_name = "Close Sprint";
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

                @if(strcmp($sprint_status,'Finished')!=0)
                    {!! Form::model($sprint, [
                                                  'method' => 'POST',
                                                  'route' => ['sprints.status', $sprint->id]  ]) !!}

                    @if(strcmp($sprint_status,'Not_Started')==0)
                        <input type="hidden" name="status" value="Started">
                    @endif

                    @if(strcmp($sprint_status,'Started')==0)
                        <input type="hidden" name="status" value="Finished">

                    @endif

                    {!! Form::submit($update_btn_display_name, ['class' => 'btn btn-primary' ]) !!}
                    {!! Form::close() !!}


                @endif

                @if(strcmp($sprint_status,'Finished')===0)
                    <div class="callout callout-info">
                        <p>This Sprint already Completed</p>
                    </div>

                    @endif
                <br>
                <br>

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