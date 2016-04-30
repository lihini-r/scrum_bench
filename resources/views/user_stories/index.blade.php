@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        .text-width {
            width: 50%;
        }

        li.nostyle {
            list-style-type: none;
        }

        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        ol.simple_with_animation li.placeholder {
            position: relative;
            list-style-type: none;
            border: 2px solid #008fb3;
            border-color: #008fb3;
        }

        ol.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }

        .table:hover {
            border: 0.5px solid #d1d1e0;
        }
    </style>
@endsection
<?php
use \App\Http\Controllers\SprintScheduleController;
use \App\Http\Controllers\SprintController;



$result = DB::table('projects')->get();
$project_id_name = array();

foreach ($result as $res) {
    $project_id_name[$res->ProjectID] = $res->ProjectName;
}

$result_developers = DB::table('users')->where('designation', '=', 'Developer')->get();
$dev_id_name = array();

foreach ($result_developers as $result_developer) {
    $dev_name = $result_developer->name;
    $dev_id = $result_developer->id;
    $dev_id_name[$result_developer->id] = $result_developer->name;

}

$dev_id_name['Not Assigned'] = "Unassigned";

//find last sprint id and due date is closable

$project_id = ($user_stories!=null && sizeof($user_stories)>0)?$user_stories[0]->project_id:"";
$sprint_id = SprintController::getLastSprintId($project_id);
$closable_value=SprintController::isSprintClosable($sprint_id);

$id_name_array = DynUI::getIdNameArray("sprints", "id", "sprint_name");

//get current sprint info for relavent project
/*$result_sprint_sts = DB::table('sprints')->where('id', '=', $sprint_id)->get();
foreach ($result_sprint_sts as $result_sprint_st) {
$sprint_status = $result_sprint_st->status;
$end_date= $result_sprint_st->end_date;
}*/
?>
@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <ul class="nav nav-pills">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                            <h3><b>Backlog</b></h3>
                        </div>
                    </div>

                    <div style="padding:0px 10px 0px 20px;">
                        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('story_search') }}"><i class="glyphicon glyphicon-search"></i></a>
                    <!--/div>
                    <div class="form-group" style="padding:0px 10px 0px 20px;"-->
                        @if(DynUI::isUserRole("Project Manager")  || DynUI::isUserRole("Account Head"))
                            <a class="btn btn-small btn-info pull-right" href="{{ URL::to('user_stories/create') }}"><i class='glyphicon glyphicon-plus'> </i>Create
                                New User Story</a>
                        @endif
                    </div>
                </ul>
                <br/>

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

                <div class="box box-default" style="padding:0px 10px 0px 20px;">
                    <div class="box-header with-border">
                        <h4><a href="{{ URL::to('sprints/' . $sprint_id) }}">{{ (sizeof($id_name_array)>0 && strcmp($sprint_id,"")!=0)?$id_name_array[$sprint_id]:"No Active Sprints Available" }}</a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Stories below</h4>
                        {!! Form::open(['route' => 'sprint_schedules.store']) !!}
                        <ol class='simple_with_animation'
                            style='list-style:none; border: 1px dashed #D9D9D9;border-radius: 10px; padding:50px 40px 50px 40px;'>
                            @foreach($user_stories as $key => $user_story)
                                <?php
                                    $storyExistInSprint = SprintScheduleController::isStoryExistInSprint($user_story->story_id, $sprint_id);
                                    $sprintExistInProject = SprintController::isSprintsExistInProject($user_story->project_id);
                                ?>
                                @if($sprintExistInProject)
                                @if($storyExistInSprint)
                                    <li class="nostyle">
                                        <input type='hidden' name='stories_to_add[]'
                                               value='{{ $user_story->story_id }}'/>
                                        <table class="table table-hover" class="table table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td width="10%"><a
                                                            href="{{ URL::to('user_stories/' . $user_story->story_id) }}">{{ $user_story->story_id }}</a>
                                                </td>

                                                <td width="20%">{{ $project_id_name[$user_story->project_id] }}</td>

                                                <td width="50%">{{ $user_story->summary }}</td>

                                                <td width="10%">
                                                    <span <?php echo ($user_story->assignee == "Not Assigned") ? "class='label label-danger'" : "class='label label-warning'"; ?> >{{ $dev_id_name[$user_story->assignee] }}</span>
                                                </td>

                                                <td width="10%">
                                                    @if(DynUI::isUserRole("Project Manager")  || DynUI::isUserRole("Account Head"))
                                                        <a class="btn btn-small btn-info" style="background-color: #005384"
                                                           href="{{ URL::to('user_stories/' . $user_story->story_id . '/edit') }}"><i class='glyphicon glyphicon-edit'> </i>Edit</a>
                                                    @endif
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </li>
                                    @endif
                                    @if(!$sprintExistInProject)
                                        no sprints
                                    @endif

                                    @endif
                            @endforeach
                                @if($storyExistInSprint)
                                @if($closable_value==true)
                                    <div class="alert alert-info">
                                        <strong>This Sprint is Already Completed !</strong> Close this Sprint and create new Sprint to start user stories
                                    </div>
                                @endif
                                @endif
                        </ol>
                        <input type="hidden" name="project_id" value="{{ $project_id  }}">
                        <input type="hidden" name="sprint_id" value="{{ $sprint_id }}">

                        {!! Form::submit('Save', ['class' => 'btn btn-primary' ,'id' => 'start-btn' ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                <br/><br/>

                <div class="box box-default" style="padding: 20px 50px 0px 20px;">
                    <div class="box-header with-border">
                        <h4>Waiting for Sprints</h4>
                        <ol class='simple_with_animation' style='list-style:none;'>

                            @foreach($user_stories as $key => $user_story)
                                <?php $storyExistInSprint = SprintScheduleController::isStoryExistInSchedule($user_story->story_id);

                                ?>

                                @if(!$storyExistInSprint)
                                    <li class="nostyle">
                                        <input type='hidden' name='stories_to_add[]'
                                               value='{{ $user_story->story_id }}'/>
                                        <table class="table table-hover" class="table table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td width="10%"><a
                                                            href="{{ URL::to('user_stories/' . $user_story->story_id) }}">{{ $user_story->story_id }}</a>
                                                </td>

                                                <td width="20%">{{ $project_id_name[$user_story->project_id] }}</td>

                                                <td width="50%">{{ $user_story->summary }}</td>

                                                <td width="10%">
                                                    <span <?php echo ($user_story->assignee == "Not Assigned") ? "class='label label-danger'" : "class='label label-warning'"; ?> >{{ $dev_id_name[$user_story->assignee] }}</span>
                                                </td>

                                                <td width="10%">
                                                    @if(DynUI::isUserRole("Project Manager")  || DynUI::isUserRole("Account Head"))
                                                        <a class="btn btn-small btn-info" style="background-color: #005384"
                                                           href="{{ URL::to('user_stories/' . $user_story->story_id . '/edit') }}"><i class='glyphicon glyphicon-edit'> </i>Edit</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
@endsection

@section('page_script2')
    <script type="text/javascript">


        var adjustment;

        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            // animation on drop
            onDrop: function ($item, container, _super) {
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                $item.animate($clonedItem.position(), function () {
                    $clonedItem.detach();
                    _super($item, container);
                });
            },

            // set $item relative to cursor position
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                        pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);
            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });
            }
        });
    </script>
@endsection