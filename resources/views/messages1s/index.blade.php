@extends('app')

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;">
    <h1>Messages</h1>
        <a class="btn btn-small btn-success pull-right glyphicon-plus" style="position: absolute;right:170px; " href="{{ URL::to('messages1s/create') }}">Compose</a>
        <a class="btn btn-small btn-info pull-right glyphicon-envelope" style="position: absolute;right:290px;" href="{{ URL::to('sentmessages') }}">Sent</a>
    </div>
   </br>

        <div class="container">
            <div class="container">

                @foreach($messages1s as $key => $messages1)
                    <div class="container" >
                        <b>
                            <h4><b><img src="{{ URL::asset('dist/img') }}/{{ $messages1->from }}.png" class="img-circle" alt="User Image" width="40px" height="40px">{{ $messages1->from }}</b></h4>
                            <br>
                        </b>
                        <pre style='overflow-y: scroll; height:60px;width: 80%'>{{ $messages1->message }}</pre>
                        <p> {{ $messages1->created_at }}


                        <a style="position: absolute;right: 180px; " href="{{  URL::to('messages1s/destroy'.$messages1->messageid) }}" class=" fa fa-trash-o"></a></p>
                        <hr/>
                    </div>
                @endforeach
            </div>
        </div>
@endsection