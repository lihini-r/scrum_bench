@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <?php
    use Illuminate\Support\Facades\DB as DB;
    use \App\Http\Controllers\WorkflowController;

    $result = DB::table('workflows')->where('story_id', '=', $user_story->story_id)->get();
    $statuses = array();

    $last_status = "To-Do";
    //$next_action = "Start";
    //$next_status = "In-Progress";

    foreach ($result as $res) {
       // echo "statuses".$res->status;
        $statuses[] = $res->status;
    }

    if(sizeof($statuses)>0){
        $last_status = $statuses[sizeof($statuses)-1];
    }else{
        $last_status = "To-Do";
    }

    $next_action = WorkflowController::getNextAction($last_status);
    $next_status = WorkflowController::getNextState($last_status);

           // echo "next action : ".$next_action;
            //echo "next status : ".$next_status;
    ?>



@endsection
<?php
 $results = DB::table('users')->get();
?>

@section('content')
    <br/>
    <div class="container">
        <br/>
        <div class="box box-default">
            <div class="box-header with-border">

                <h1>User Story {{ $user_story->story_id }}</h1>
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#">Edit</a>
                    </li>
                    <!--<li role="presentation"><a href="#" data-toggle="modal" data-target="#assign-me">Assign To Me</a></li>-->
                    <li role="presentation"><a href="#" data-toggle="modal" data-target="#work-log">WorkLog</a></li>
                    <li role="presentation"><a href="#" data-toggle="modal" data-target="#work-flow">{{$next_action}}</a></li>


                <div class="form-group" style="padding:20px 30px 20px 20px;">
                    <a class="btn btn-small btn-info pull-right" href="{{ url('/worklogs?story_id='.$user_story->story_id) }}">View My Work Logs</a>
                </div>
                </ul>
                <br/><br/><br/>

                <div class="row">
                    <div class="col-sm-6">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Project</td>
                                <td>{{ $user_story->project_id }}</td>
                            </tr>
                            <tr>
                                <td>Summary</td>
                                <td>{{ $user_story->summary }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $user_story->description }}</td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>{{ $user_story->priority }}</td>
                            </tr>
                            <tr>
                                <td>Original Estimate</td>
                                <td>{{ $user_story->org_est }}</td>
                            </tr>
                            <tr>
                                <td>Due Date</td>
                                <td>{{ $user_story->due_date }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-4">
                        <table class="table pull-right">
                            <tbody>
                            <tr>
                                <td><a href="#" data-toggle="modal" data-target="#assign-me">assignee</a></td>
                                <td>{{ $user_story->assignee }}</td>
                            </tr>
                            <tr>
                                <td>Reporter</td>
                                <td>{{ $user_story->reporter }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $last_status }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!--work flow Modal -->
                <div id="work-flow" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Story Assignment</h4>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            {!! Form::open(['route' => 'workflows.store']) !!}
                                            <p>Successfully started the user story</p>

                                            <input type="hidden" name="story_id" value="{{$user_story->story_id}}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                            <input type="hidden" name="status" value="{{$next_status}}">
                                            Date
                                            <input class="form-control" name="updated_date" type="text"
                                                   placeholder="Enter date"
                                                   style="width: 50%;"/>
                                            <div class="modal-footer">
                                                {!! Form::submit('Update Status', ['class' => 'btn btn-primary' ]) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>

                        </div>

                    </div>
                </div>


                <!--Work Log Modal -->
                <div id="work-log" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Log Your Work</h4>
                            </div>
                            <div class="modal-body">
                                {{Session::get($user_story->story_id.'-'.Auth::user()->id)}}
                                {{Session::get($user_story->story_id.'-'.Auth::user()->id."-id")}}
                                {{"Condition : ".(strcmp(Session::get($user_story->story_id.'-'.Auth::user()->id),'started')==0)}}

                                @if(strcmp(Session::get($user_story->story_id.'-'.Auth::user()->id),'started')!=0)
                                    {!! Form::open(['route' => 'worklogs.store']) !!}
                                    Start Date
                                    <input class="form-control" name="work_start_date" type="text"
                                           placeholder="Enter in hours"
                                           style="width: 50%;"/>
                                    <input type="hidden" name="description" value="STARTED">
                                    <input type="hidden" name="story_id" value="{{$user_story->story_id}}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                    <div class="modal-footer">
                                        {!! Form::submit('Start User Story', ['class' => 'btn btn-primary' ,'id' => 'start-btn' ]) !!}
                                        {!! Form::close() !!}
                                    </div>

                                @endif
                                @if(strcmp(Session::get($user_story->story_id.'-'.Auth::user()->id),'started')==0)
                                    {!! Form::model(new \App\Worklog(), [
                                        'method' => 'PATCH',
                                        'route' => ['worklogs.update', Session::get($user_story->story_id.'-'.Auth::user()->id."-id")]
                                    ]) !!}
                                    Description
                                    <textarea class="form-control" placeholder="Enter ..." rows="3" name="description"
                                              style="width: 100%;"
                                              tabindex="2" id="desc-txt"></textarea>
                                    End Date
                                    <input class="form-control" name="work_end_date" type="text"
                                           placeholder="Enter in hours"
                                           style="width: 50%;"/>

                                    <input type="hidden" name="story_id" value="{{$user_story->story_id}}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                    <div class="modal-footer">
                                        {!! Form::submit('Update User Story', ['class' => 'btn btn-primary' ,'id' => 'end-btn' ]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>

                <!--Assign to me Modal -->
                <div id="assign-me" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Story Assignment</h4>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="box box-default">
                                        <div class="box-header with-border">

                                            {!! Form::model($user_story, [
                                              'method' => 'POST',
                                              'route' => ['user_stories.assign', $user_story->story_id]        ]) !!}
                                            <p>Select developer</p>


                                            <select class="form-control select2 select2-hidden-accessible"
                                                    name="assignee" style="width: 50%;"
                                                    tabindex="-1"
                                                    aria-hidden="true">

                                                <option>dev1</option>
                                                <option>dev2</option>
                                                <option>dev3</option>
                                                <option>dev4</option>


                                            </select>

                                            <div class="modal-footer">
                                                {!! Form::submit('Assign User Story', ['class' => 'btn btn-primary' ]) !!}
                                                {!! Form::close() !!}
                                            </div>

                                        </div>
                                    </div>

                                </section>

                            </div>
                            <!-- <div class="modal-footer">
                                 <button type="submit" class="btn btn-default" data-dismiss="modal">OK</button>
                             </div>-->


                        </div>

                    </div>
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