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

$id_name_array = DynUI::getIdNameArray("users", "id", "name");
$id_name_array['Not Assigned'] = "Not Assigned";

$id_project_name_array = DynUI::getProjectIdNameArray();


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
                        <h3><b>Editing User Story {{ $user_story->story_id }}</b></h3>
                    </div>
                </div>
                <p class="lead">
                    <small>Edit and save User Story below, or <a href="{{ route('user_stories.index') }}"> Back to
                            Backlog</a></small>
                </p>
                <hr>
                {!! Form::model($user_story, [
					'method' => 'PATCH',
					'route' => ['user_stories.update', $user_story->story_id]
				,'role' => 'form' , 'data-toggle' => 'validator']) !!}
                <input type="hidden" name="operation" value="insert">
                <input type="hidden" name="id" value="null">
                <div class="form-group">
                    Project Name<select class="form-control select2 select2-hidden-accessible" name="project_id"
                                        style="width: 50%;"
                                        tabindex="-1"
                                        aria-hidden="true" readonly="true">
                        <?php
                        echo "<option value='" . $user_story->project_id . "'>" . $id_project_name_array[$user_story->project_id] . "</option>";
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    Task<textarea class="form-control" placeholder="Enter ..." rows="3" name="summary"
                                  style="width: 50%;"
                                  tabindex="2" required><?php  echo $user_story->summary;    ?></textarea>
                    <div class="help-block with-errors">
                    </div>
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
                        <input type="hidden" id="due-date-data" value="<?php echo $user_story->due_date; ?>"/>
                        <input type='text' class="form-control" name="due_date"/>
                                               <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                    </div>
                </div>

                <div class="form-group">
                    Asignee<select class="form-control select2 select2-hidden-accessible" name="assignee"
                                   style="width: 50%;"
                                   tabindex="-1"
                                   aria-hidden="true" readonly="true">
                        <?php echo "<option value='$user_story->assignee'>" . $id_name_array[$user_story->assignee] . "</option>"; ?>
                    </select>
                </div>


                <div class="form-group">
                    Reporter<select class="form-control select2 select2-hidden-accessible" name="reporter"
                                    style="width: 50%;"
                                    tabindex="-1"
                                    aria-hidden="true" readonly="true">
                        <?php echo '<option>' . $user_story->reporter . '</option>'; ?>
                    </select>
                </div>

                <div class="form-group">
                    Description<textarea class="form-control" placeholder="Enter ..." name="description" rows="3"
                                         style="width: 50%;"
                                         tabindex="2" required> <?php echo $user_story->description; ?></textarea>
                    <div class="help-block with-errors">
                    </div>
                </div>
                <div class="form-group">
                    Orginal Estimate-(Hours)<input class="form-control" name="org_est"
                                                   placeholder="Enter original estimate from hours"
                                                   style="width: 50%;" type="number"
                                                   value="<?php echo $user_story->org_est; ?>" required/>
                    <div class="help-block with-errors">
                    </div>
                </div>

                {!! Form::submit('Update User Story', ['class' => 'btn btn-primary']) !!}
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
            //var dateNow = new Date();
            $('#duedate').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD',
                //minDate: moment(dateNow),
                defaultDate: $('#due-date-data').val(),
                //daysOfWeekDisabled: [0, 6]
            });
        });
    </script>
@endsection
