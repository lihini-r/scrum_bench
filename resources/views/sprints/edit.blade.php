@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <style>
        .text-width {
            width: 50%;
        }
    </style>
@endsection
<?php
$id_project_name_array = DynUI::getProjectIdNameArray();
?>

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Edit {{ $sprint->sprint_name }}</b></h3>
                    </div>
                </div>
                <p class="lead">
                    <small>Edit and save this Sprint below, or <a href="{{ route('sprints.index') }}">Go back to
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

                {!! Form::model($sprint, [
                'method' => 'PATCH',
                'route' => ['sprints.update', $sprint->id], 'data-toggle' => 'validator'
            ]) !!}

                <div class="form-group">
                    {!! Form::label('sprint_name', 'Sprint Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('sprint_name', null, ['class' => 'form-control','style' => 'width:50%;','readonly'=>'true']) !!}
                </div>

                <div class="form-group">
                    Project Name<select class="form-control select2 select2-hidden-accessible" name="project_id"
                                        style="width: 50%;"
                                        tabindex="-1"
                                        aria-hidden="true" readonly="true">
                        <?php
                        echo "<option value='" . $sprint->project_id . "'>" . $id_project_name_array[$sprint->project_id] . "</option>";
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <div class="control-label">Start Date</div>
                    <div class='input-group date' id='start_date_picker' style='width:50%;'>
                        <input type="hidden" id="start-date-data" value="<?php echo $sprint->start_date; ?>"/>
                        <input type='text' class="form-control" name="start_date" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    <div class="control-label">End Date</div>
                    <div class='input-group date' id='end_date_picker' style='width:50%;'>
                        <input type="hidden" id="end-date-data" value="<?php echo $sprint->end_date; ?>"/>
                        <input type='text' class="form-control" name="end_date" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>

                {!! Form::submit('Update Sprint', ['class' => 'btn btn-primary']) !!}

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

        $(function () {
            $('#start_date_picker').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                defaultDate: $('#start-date-data').val(),
                //daysOfWeekDisabled: [0, 6]
            });
            $('#end_date_picker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                defaultDate: $('#end-date-data').val(),
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