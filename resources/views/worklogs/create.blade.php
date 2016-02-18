@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <style>
        .text-width {
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <br/>
                <p class="lead">Create and save new Sprint below, or <a href="{{ route('worklogs.index') }}">Go back to all Sprints</a></p>
                <hr>
                <div class="container">
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
                        {!! Form::label('description', 'Sprint Name:', ['class' => 'control-label']) !!}
                        <input class="form-control" style="width:50%;" name="description" type="text" id="description" required>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('project_id', 'Project ID:', ['class' => 'control-label']) !!}
                        <input class="form-control" style="width:50%;" name="project_id" type="text" id="project_id"  required>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <div class="control-label">Start Date</div>
                        <div class='input-group date' id='start_date_picker' style ='width:50%;'>
                            {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
                            <span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label">End Date</div>
                        <div class='input-group date' id='end_date_picker' style ='width:50%;'>
                            {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
                            <span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
                        </div>
                    </div>

                    {!! Form::submit('Create Sprint', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
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
    <script src="{{ URL::asset('bootstrap/js/moment.js') }}"></script>
    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#start_date_picker').datepicker({
                viewMode: 'years',
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                daysOfWeekDisabled: [0, 6]
            });
            $('#end_date_picker').datepicker({
                viewMode: 'years',
                useCurrent: false,
                format: 'yyyy-mm-dd',
                daysOfWeekDisabled: [0, 6]
            });
            /*$("#start_date_picker").on("changeDate", function (e) {
             $('#end_date_picker').data("DatePicker").minDate(e.date);
             });
             $("#end_date_picker").on("changeDate", function (e) {
             $('#start_date_picker').data("DatePicker").maxDate(e.date);
             });*/
        });
    </script>
@endsection