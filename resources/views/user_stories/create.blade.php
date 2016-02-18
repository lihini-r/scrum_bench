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

<?php $results = DB::table('projects')->get(); ?>
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



            <div class="box box-default">
                <div class="box-header with-border">

                    <br/>
                    <h2>Create New User Story</h2>
					<br/>
                    <p class="lead">Create and save this User Story below, or   <a href="{{ route('user_stories.index') }}">Go back to Backlog</a></p>
                    <hr>
                    {!! Form::open(['route' => 'user_stories.store']) !!}
                        <input type="hidden" name="operation" value="insert">
                        <input type="hidden" name="id" value="null">
                        <div class="form-group">
                            Project Name<select class="form-control select2 select2-hidden-accessible" name="project_id" style="width: 50%;"
                                                tabindex="-1"
                                                aria-hidden="true">
                                <?php
                                foreach ($results as $result) {
                                    $prj_id = $result->project;
                                    $prj_name=$result->project_name;
                                    $pmngr = $result->project_manager;

                                    echo "<option value = '$prj_id' >$prj_name</option >";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            Summary<textarea class="form-control" placeholder="Enter ..." rows="3" name="summary" style="width: 50%;"
                                             tabindex="2"></textarea>
                        </div>

                        <div class="form-group">
                            Priority<select class="form-control select2 select2-hidden-accessible" name="priority" style="width: 50%;"
                                            tabindex="-1"
                                            aria-hidden="true">
                                <option>major</option>
                                <option>minor</option>
                                <option>blocker</option>
                            </select>
                        </div>


                        <div class="form-group">Due Date
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar">
                                    </i>
                                </div>
                                <input class="form-control" type="text" data-mask="" name="due_date"
                                       data-inputmask="'alias': 'yyyy-mm-dd'"
                                       style="width: 48.5%;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            Asignee<select class="form-control select2 select2-hidden-accessible" name="assignee" style="width: 50%;"
                                           tabindex="-1"
                                           aria-hidden="true">
                                <option selected="selected">
                                    dev1
                                </option>
                                <option>dev2</option>
                                <option>dev3</option>
                            </select>
                        </div>


                        <div class="form-group">
                            Reporter<select class="form-control select2 select2-hidden-accessible" name="reporter" style="width: 50%;"
                                            tabindex="-1"
                                            aria-hidden="true">
                                <option selected="selected">
                                    PM-1
                                </option>
                                <option>PM-2</option>
                                <option>PM-3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            Description<textarea class="form-control" placeholder="Enter ..." name="description" rows="3" style="width: 50%;"
                                                 tabindex="2"></textarea>
                        </div>

                        <div class="form-group">
                            Orginal Estimate<input class="form-control" name="org_est" type="text" placeholder="Enter original estimate from hours"
                                                   style="width: 50%;" type="number"/>
                        </div>


                    {!! Form::submit('Create User Story', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}


                </div>
            </div>



    </div>


@endsection


<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>


<!-- Page script -->
<script>

    $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Money Euro
        $("[data-mask]").inputmask();
    });
</script>