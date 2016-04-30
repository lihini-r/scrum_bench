@extends('app')
@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;" xmlns="http://www.w3.org/1999/html">
        <h1>Assigned Projects</h1>
    </div>
    <div class="container">
        <div class="container">

            {{--Display all user Tasks--}}
            @foreach($notifications as $key => $notification)
                <div class="box box-default" style="padding: 10px 50px 0px 20px;">
                    <div class="box-header with-border">
                        <div class="panel panel-title" style="background-color:#bce8f1">
                            <div class="panel-heading" style="padding:8px 10px 15px 20px;">
                                <p><b>{{ $notification->id }}: {{ $notification->ProjectName }} Assigned</b></p>
                            </div>
                        </div>
                        <p>{{ $notification->created_at }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection