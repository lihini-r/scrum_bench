@extends('app')
@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;" xmlns="http://www.w3.org/1999/html">
        <h1>My Tasks</h1>
    </div>
    <div class="container">
        <div class="container">
            <!--get all sent messages-->


            @foreach($tasks as $key => $task)

                <div class="box box-default" style="padding: 10px 50px 0px 20px;">
                    <div class="box-header with-border">
                        <a  href="{{ URL::to('tasks/' . $task->story_id) }}">

                            <div class="panel panel-title" style="background-color:#ffdbe7">
                                <div class="panel-heading" style="padding:8px 10px 45px 20px;">
                                    <p>
                                        <b>{{ $task->story_id }}</b>
                                        :{{ $task->summary }}
                                        <small style="position: absolute;right:570px;top: 50px; " class="pull-right">{{$task->org_est}} %</small>
                                    </p>
                                 </div>
                                <div class="progress xs" style="width: 460px; position: absolute;left:30px;bottom: 40px">
                                    <!-- Change the css width attribute to simulate progress -->
                                    <div class="progress-bar progress-bar-aqua" style="width:{{$task->org_est}}%"
                                         role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                         aria-valuemax="100">

                                    </div>
                                </div>
                            </div>
                        </a>
                        <p>{{ $task->created_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection