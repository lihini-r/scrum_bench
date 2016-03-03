@extends('app')

@section('content')

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
                <h1>
                    Post Codes
                </h1>
            </div>
            <div class="container">
                <div class="container">

        {!! Form::open(['route' => 'codeshares.store']) !!}


            <br>
            <br>
        <div class="form-group">
            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control' , 'style' => 'width:40%;']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('language', 'Language', ['class' => 'control-label']) !!}
            <select id="language" name="language" class="form-control" style="width: 250px">
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

            </select>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
            <textarea id="description" name="description" class="form-control" placeholder="Your description here" rows="2" cols="50" style="width: 500px">  </textarea>
        </div>

        <div class="form-group">
            {!! Form::label('sourceCode', 'Source Code', ['class' => 'control-label']) !!}
            <textarea  id="sourceCode" name="sourceCode" class="form-control" rows="6" cols="50" placeholder="Your Code" style='width: 500px'> </textarea>
        </div>

        {!! Form::submit('Post', ['class' => 'btn btn-success']) !!}
                {!! Form::reset('Reset', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
            </div>
            </div>


    </div>


@endsection