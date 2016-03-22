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
    <br/>
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <br/>
                <!--display error messages if any-->
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

                    <div class="form-group">
                        <!-- form heading-->
                        <h1>Other mails</h1>
                    </div>
                        <hr>

                    <br>
                    <br>
                    <div class="container">
                        {!! Form::open(['route' => 'eothers.store', 'method'=>'POST', 'role' => 'form' , 'data-toggle' => 'validator','enctype'=>'multipart/form-data']) !!}

                        <div class="form-group" >
                            {!! Form::label('recipient', 'Email', ['class' => 'control-label']) !!}
                            <input class="form-control" style="width:40%;" name="recipient" type="text" id="recipient" placeholder="To" required>
                        </div>

                        <div class="form-group" >
                            {!! Form::label('sender', 'Email', ['class' => 'control-label']) !!}
                            <input class="form-control" style="width:40%;" name="sender" type="text" id="sender" placeholder="From" required>
                        </div>


                        <div class="form-group">
                            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                            <input class="form-control" style="width:40%;" name="subject" type="text" id="subject"  required>
                        </div>

                        <div class="form-group">
                            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                            <textarea id="message" name="message" rows="10" cols="40" style='width: 450px' class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            {!! Form::label('File', 'File Input', ['class' => 'control-label']) !!}
                            {!! Form::file('File', null, ['class' => 'form-control' , 'style' => 'width:40%;']) !!}
                        </div>
                        <!--submit form details to store-->
                        {!! Form::submit('Send', ['class' => 'btn btn-success']) !!}
                                <!--reset form details to entered-->
                        {!! Form::reset('Reset', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
@endsection