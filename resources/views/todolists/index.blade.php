@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <style>
        .text-width {
            width: 50%;
        }

        .lightBlue{ background-color:#1ab7ea;
                    color:#1ab7ea;
                   }

        .purple{ background-color:#8677A7;
                 color:#8677A7;
                }

        .darkBlue{ background-color:#204d74;
                   color:#204d74;
                  }

        .pink{ background-color:#c3325f;
               color:#c3325f;
              }

        .orange{ background-color:#ce563f;
                 color:#ce563f;
                }

        .green{ background-color: #2caf8d;
                color: #2caf8d;
              }
        .transparent{ background-color: rgba(181, 181, 181, 0);
            color: rgba(44, 175, 141, 0);
        }



    </style>
@endsection

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;">
        <h1>To-Do list</h1>

        <a class="btn btn-small btn-success pull-right glyphicon-plus" style="position: absolute;right:170px; " href="#" data-toggle="modal" data-target="#add-task">New Task</a>

        <div id="add-task" class="modal fade" role="dialog">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#337ab7">
                        <!-- Modal button to close form-->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: white"><b>YOUR TASK</b></h4>
                    </div>
                    <div class="modal-body">
                        <section class="content">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <!-- route to store method in controller to store data-->
                                    {!! Form::open(['route' => 'todolists.store','role' => 'form' , 'data-toggle' => 'validator']) !!}
                                            <!-- get current user name-->

                                    <div class="form-group">
                                        {!! Form::label('task', 'Task', ['class' => 'control-label']) !!}
                                                <!-- get task-->
                                        <textarea id="task" name="task" rows="1" cols="10" style='width: 500px' class="form-control" required></textarea>
                                        <input type='hidden' id='userName' style="width: 0px" name='userName' value="{{ Auth::user()->name }}"  >


                                    </div>
                                    <div class="form-group">
                                        <div class='input-group date' id='duedate' style="width: 50%;">
                                            <input type='text' class="form-control" name="task_date" />
                                               <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                                        </div>
                                    </div>

                                    <select class="form-control select2 select2-hidden-accessible"
                                            id='color' name='color' style="width: 30%;"
                                            tabindex="-1"
                                            aria-hidden="true">
                                        <option class="lightBlue">#1ab7ea</option>
                                        <option class="purple">#8677A7</option>
                                        <option class="darkBlue">#204d74</option>
                                        <option  class="pink">#c3325f</option>
                                        <option class="orange">#ce563f</option>
                                        <option class="green">#2caf8d</option>

                                    </select>

                                    <div class="modal-footer">
                                        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- <a class="btn btn-small btn-success pull-right glyphicon-plus" style="position: absolute;right:170px; " href="{{ URL::to('messages1s/create') }}">Compose</a>-->
        <!-- directs to send messages page
        <a class="btn btn-small btn-info pull-right glyphicon-envelope" style="position: absolute;right:290px;" href="{{ URL::to('sentmessages') }}">Sent</a>-->
    </div>
    </br>

    <div class="container">
        <div class="container">

            <!-- get all recent tasks-->
            @foreach($tasks as $key => $task)
                <div class="container" >


                    <pre  class="panel panel-title" style=" font-family:'Microsoft Sans Serif' , Arial, Helvetica, Verdana;color:#FFFFFF;height:60px;width: 72%;background-color: {{$task->color}}">{{ $task->task }}</pre></a>
                    <!-- display task added date and time-->
                    <p > {{ $task->task_date }}</p>
                    {!! Form::model($task,['method'=>'DELETE','route'=>['todolists.destroy',$task->task_id] ]) !!}
                    <!--delete task-->
                    <button  style="position: absolute;right: 170px;color: #f00000 " class="close" type="submit" id="btnDelete"> <i class="fa fa-trash-o"></i> </button>
                    {!! Form::close() !!}
                    <hr/>
                    <br>
                </div>
            @endforeach
        </div>
    </div>

@endsection



@section('page_script1')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
@endsection

@section('page_script2')
    {{--<script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>--}}
    {{--<script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>--}}
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var dateNow = new Date();
            $('#duedate').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD hh:mm:ss ',
                defaultDate:moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6],

            });
        });

    </script>
@endsection