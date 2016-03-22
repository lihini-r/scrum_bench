@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <style>
        .text-width {
            width: 50%;
        }
    </style>
@endsection
<?php $results = DB::table('projects')->get(); ?>
@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Create New Sprint</b></h3>
                    </div>
                </div>
                <p class="lead">
                    <small>Create and save new Sprint below, or <a href="{{ route('sprints.index') }}">Go back to
                            all Sprints</a></small>
                </p>
                <hr>

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

                {!! Form::open(['route' => 'sprints.store' , 'role' => 'form' , 'data-toggle' => 'validator']) !!}


                <div class="form-group">
                    {!! Form::label('project_id', 'Project ID:', ['class' => 'control-label']) !!}
                            <!--<input class="form-control" style="width:50%;" name="project_id" type="text" id="project_id"  required>-->
                    <select class="form-control select2 select2-hidden-accessible" name="project_id"
                            style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
                        <?php
                        foreach ($results as $result) {
                            $prj_id =$result->ProjectID;
                            $prj_name = $result->ProjectName;


                            echo "<option value = '$prj_id' >$prj_name</option >";
                        }
                        ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    <div class="control-label">Start Date</div>
                    <div class='input-group date' id='start_date_picker' style='width:50%;'>
                        <input type='text' class="form-control" name="start_date" required/>
                        <div class="help-block with-errors"></div>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="control-label">End Date</div>
                    <div class='input-group date' id='end_date_picker' style='width:50%;'>
                        <input type='text' class="form-control" name="end_date" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>

                {!! Form::submit('Create Sprint', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
                <br/>
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
        /*$(function () {
         $('#start_date_picker').datetimepicker({
         viewMode: 'years',
         format: 'YYYY-MM-DD ',
         daysOfWeekDisabled: [0, 6]
         });
         });
         $(function () {
         $('#end_date_picker').datetimepicker({
         viewMode: 'years',
         format: 'YYYY-MM-DD ',
         daysOfWeekDisabled: [0, 6]
         });
         });*/

        $(function () {
            var dateNow = new Date();
            $('#start_date_picker').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                defaultDate: moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $('#end_date_picker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                //daysOfWeekDisabled: [0, 6]
            });
            $("#start_date_picker").on("dp.change", function (e) {
                $('#end_date_picker').data("DateTimePicker").minDate(e.date);
            });
            $("#end_date_picker").on("dp.change", function (e) {
                $('#start_date_picker').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endsection