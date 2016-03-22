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
use \App\Http\Controllers\StoryController;
$results = DB::table('projects')->get();
$assigned_project=StoryController::getAssignedProject();


?>
@section('content')
    <br/>

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


        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">

                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Create New User Story</b></h3>
                    </div>
                </div>

                <p class="lead"><small>Create and save this User Story below, or <a href="{{ route('user_stories.index') }}">Go
                        back to Backlog</a></small></p>
                <hr>
                {!! Form::open(['route' => 'user_stories.store','role' => 'form' , 'data-toggle' => 'validator']) !!}
                <input type="hidden" name="operation" value="insert">
                <input type="hidden" name="id" value="null">
                <div class="form-group">
                    Project Name<select class="form-control select2 select2-hidden-accessible" name="project_id"
                                        style="width: 50%;"
                                        tabindex="-1"
                                        aria-hidden="true">
                        <?php
                        foreach ($results as $result) {
                            $prj_id = $result->ProjectID;
                            $prj_name = $result->ProjectName;
                            echo "<option value = '$prj_id' >$prj_name</option >";
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    Task<textarea class="form-control" placeholder="Enter ..." rows="3" name="summary"
                                  style="width: 50%;"
                                  tabindex="2" required></textarea>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    Priority<select class="form-control select2 select2-hidden-accessible" name="priority"
                                    style="width: 50%;"
                                    tabindex="-1"
                                    aria-hidden="true">
                        <option>major</option>
                        <option>minor</option>
                        <option>blocker</option>
                    </select>
                </div>
                Due Date
                <div class="form-group">
                    <div class='input-group date' id='duedate' style="width: 50%;">
                        <input type='text' class="form-control" name="due_date" />
                                               <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                    </div>
                </div>

                <div class="form-group">
                    Assignee<input class="form-control" name="assignee" type="text"
                                   style="width: 50%;" type="number" value="Not Assigned" readonly/>
                </div>

                <div class="form-group">
                    Reporter<input class="form-control" name="reporter" type="text"
                                   style="width: 50%;" type="text" value="{{ Auth::user()->name}}" readonly/>
                </div>

                <div class="form-group">
                    Description<textarea class="form-control" placeholder="Enter ..." name="description" rows="3"
                                         style="width: 50%;"
                                         tabindex="2" required></textarea>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    Orginal Estimate-(Hours)<input class="form-control" name="org_est"
                                                   placeholder="Enter original estimate from hours"
                                                   style="width: 50%;" type="number" required/>
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    {!! Form::submit('Create User Story', ['class' => 'btn btn-primary']) !!}
                    {!! Form::reset('Reset', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}


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
            var dateNow = new Date();
            $('#duedate').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                defaultDate:moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6],

            });
        });

    </script>
@endsection
