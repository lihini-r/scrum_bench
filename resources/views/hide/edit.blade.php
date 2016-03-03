@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
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
                <h1 style="color: #00a157">Hide Project{{  $project->default.$project->ProjectID }}</h1>
                <p class="lead">Hide this Project below, or <a href="{{ route('projects.index') }}">Go back to all Projects</a></p>
                <hr>
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

                <div class="col-md-7" style="background-color:  #99ee99">
                <br>

                {!! Form::model( $project, [
                'method' => 'PATCH',
                'route' => ['hide.update',$project->ProjectID]
            ]) !!}

                <div class="form-group">
                    {!! Form::label('ProjectName', 'Project Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('ProjectName', null, ['class' => 'form-control','style' => 'width:50%;','readonly'=>'true']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Description', 'Description:', ['class' => 'control-label']) !!}
                    {!! Form::text('Description', null, ['class' => 'form-control', 'style' => 'width:50%;','readonly'=>'true']) !!}
                </div>

                  <div class="form-group">
                    {!! Form::label('State', 'State:', ['class' => 'control-label']) !!}
                {!! Form::text('State',  $project->State, ['class' => 'form-control', 'style' => 'width:50%;','readonly'=>'true']) !!}
                        </div>


                    <div class="form-group">

                  <b> Hide Project</b><input type="checkbox" checked="checked" name="Hide" value="on"  style="width: 10%;"/>

                </div>



                {!! Form::submit('Hide Project', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
                    <br>
            </div>
        </div>
        </div></div>

@endsection

