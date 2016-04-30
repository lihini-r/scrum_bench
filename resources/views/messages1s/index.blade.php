@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        .text-width {
            width: 50%;
        }
    </style>
@endsection

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;">
        <h1>Message Inbox</h1>
        <!--Display button to go to send message form-->
        <a class="btn btn-small btn-success pull-right glyphicon-plus" style="position: absolute;right:170px; " href="#" data-toggle="modal" data-target="#send-messages">Compose</a>

        <div id="send-messages" class="modal fade" role="dialog">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#337ab7">
                        <!-- Modal buuton to close form-->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: white">SEND MESSAGE</h4>
                    </div>
                    <div class="modal-body">
                        <section class="content">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <!-- form to enter new message-->
                                    {!! Form::open(['route' => 'messages1s.store','role' => 'form' , 'data-toggle' => 'validator']) !!}
                                    <div class="form-group">
                                        {!! Form::label('to', 'To', ['class' => 'control-label']) !!}

                                        <select class="form-control select2 select2-hidden-accessible"
                                                id='to' name='to' style="width: 50%;"
                                                tabindex="-1"
                                                aria-hidden="true">
                                            <?php
                                            $user = \Auth::user()->name;
                                            $names = DB::table('users')->where('name', '!=', $user)->get();
                                            foreach ($names as $name)
                                            {
                                                $value = $name->name;
                                                echo "<option >$value</option >";
                                            }
                                            ?>
                                        </select>

                                        <input type='hidden' id='from' style="width: 0px" name='from' value="{{ Auth::user()->name }}"  >
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                                        <textarea id="message" name="message" rows="6" cols="10" style='width: 500px' class="form-control" required></textarea>

                                    </div>

                                    <div class="modal-footer">
                                        {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-small btn-info pull-right glyphicon-envelope" style="position: absolute;right:290px;" href="{{ URL::to('sentmessages') }}">Sent</a>
    </div>
    </br>

    <div class="container">
        <div class="container">

            <!-- get all user's recieved messages-->
            @foreach($messages1s as $key => $messages1)
                <div class="container" >
                    <h4><b><img src="{{ URL::asset('dist/img') }}/{{ $messages1->from }}.png" class="img-circle" alt="User Image" width="40px" height="40px">{{ $messages1->from }}</b></h4>
                    <br>

                    <!--  <a  href="{{ URL::to('messages1s/' . $messages1->messageid) }}"> -->
                    <pre style='overflow-y: scroll; height:60px;width: 80%'>{{ $messages1->message }}</pre></a>
                    <p> {{ $messages1->created_at }}</p>
                    {!! Form::model($messages1,['method'=>'DELETE','route'=>['messages1s.destroy',$messages1->messageid] ]) !!}
                            <!-- delete message-->
                    <button  style="position: absolute;right: 100px;color: #f00000 " class="close" type="submit" id="btnDelete"> <i class="fa fa-trash-o"></i> </button>
                    <!--<a style="position: absolute;right: 180px; " href="{{  URL::to('messages1s/destroy'.$messages1->messageid) }}" class=" fa fa-trash-o"></a></p>-->
                    {!! Form::close() !!}
                    <hr/>
                </div>
            @endforeach
        </div>
    </div>

@endsection



@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
@endsection