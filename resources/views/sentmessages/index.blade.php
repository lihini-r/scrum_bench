@extends('app')

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;">
        <h1>Message Outbox</h1>
    </div>
    <div class="container">
        <div class="container">
            <!--get all sent messages-->
            @foreach($messages1s as $key => $messages1)

                <div class="container" >
                    <!--display message receiver's profile picture and name-->
                    <h4><b><img src="{{ URL::asset('dist/img') }}/{{ $messages1->to }}.png" class="img-circle" alt="User Image" width="40px" height="40px">{{ $messages1->to }}</b></h4>
                    <br>
                    <!--display message -->
                    <pre style='overflow-y: scroll; height:60px;width: 80%'>{{ $messages1->message }}</pre>
                    <p>
                        <!--display message sent date and time-->
                        {{ $messages1->created_at }}
                    </p>
                    <!--delete message -->
                    {!! Form::model($messages1,['method'=>'DELETE','route'=>['sentmessages.destroy',$messages1->messageid] ,'class'=>'delete' ]) !!}

                    <button  style="position: absolute;right: 100px;color: #f00000 " class="close" type="submit" id="btnDelete"> <i class="fa fa-trash-o"></i> </button>
                    <!--<a style="position: absolute;right: 180px; " href="{{ route('messages1s.destroy', $messages1->messageid) }}" class=" fa fa-trash-o"></a>-->
                    {!! Form::close() !!}
                    <hr/>
                </div>

            @endforeach
        </div>
    </div>

@endsection