<!--Hide projects in peojects/index-->

@extends('app')

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <br/>

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


                <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
                    <div class="box-header with-border">

                        <div class="panel panel-info">

                            <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                                <h1 style="color: #00a157">Hide Project{{  $project->default.$project->ProjectID }}</h1>
                            </div>

                        </div>



                        <div class="col-md-7" style="background-color:  #7adddd">
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
    </div>
    </div>

@endsection


