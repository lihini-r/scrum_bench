<!--Post codes -->
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
                        <h1>Post Your Code</h1>
                    </div>
                    <hr>
                    <div class="form-group" style="padding:20px 30px 20px 20px; position: absolute;top: 140px;right: 150px">
                        <!-- View all posted codes-->
                        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('codeshares/') }}">View my code</a>
                    </div>

                    <div class="container">

                        <!--form to post codes-->
                        {!! Form::open(['route' => 'codeshares.store','role' => 'form' , 'data-toggle' => 'validator']) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                            <input type='hidden' id='name' style="width: 0px" name='userName' value="{{ Auth::user()->name }}"  >
                            <input class="form-control" style="width:40%;" name="title" type="text" id="title"  required>

                        </div>

                        <div class="form-group">
                            {!! Form::label('language', 'Language', ['class' => 'control-label']) !!}
                            <select id="language" name="language" class="form-control" style="width: 250px" >
                                <option>C</option>
                                <option>C#</option>
                                <option>C++</option>
                                <option> CSS</option>
                                <option> HTML</option>
                                <option>Java</option>
                                <option>JavaScript</option>
                                <option>MatLab</option>
                                <option> Objective-C</option>
                                <option>Pascal</option>
                                <option>Perl</option>
                                <option>PHP</option>
                                <option>Python</option>
                                <option>Ruby</option>
                                <option>SQL</option>
                                <option>XML</option>
                            </select >
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                            <textarea id="description" name="description" class="form-control" placeholder="Your description here" rows="2" cols="50" style="width: 500px">  </textarea>
                        </div>

                        <div class="form-group">
                            {!! Form::label('sourceCode', 'Source Code', ['class' => 'control-label']) !!}
                            <textarea id="sourceCode" name="sourceCode" rows="10" cols="40" style='width: 450px' class="form-control" required></textarea>

                        </div>
                        {!! Form::submit('Post', ['class' => 'btn btn-success']) !!}
                        {!! Form::reset('Reset', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
@endsection

@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/moment.js') }}"></script>

@endsection