@extends('app')



@section('content')
    <br/>
    <div class="container">

        <div class="box box-default">
            <div class="box-header with-border">
                <br/>
                <h6 class="lead">Edit and save this Project below, or <a href="{{ route('projects.index') }}">Go back to all Projects</a></h6>
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

                                <h1 style="color: #00a157">Editing Project{{  $project->default.$project->ProjectID }}</h1>
                            </div>

                        </div>





                        <div class="col-md-7" style="background-color:  #7adddd">
                    <br>


                                {!! Form::model( $project, [
                                'method' => 'PATCH',
                                'route' => ['projects.update',$project->ProjectID]]) !!}

                                <div class="form-group">
                                    {!! Form::label('ProjectName', 'Project Name:', ['class' => 'control-label']) !!}
                                    {!! Form::text('ProjectName', null, ['class' => 'form-control','style' => 'width:50%;','readonly'=>'true']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Description', 'Description:', ['class' => 'control-label']) !!}
                                    {!! Form::text('Description', null, ['class' => 'form-control', 'style' => 'width:50%;',]) !!}
                                </div>


                                <div class="form-group">
                                   State<select class="form-control" name="State" style="width: 50%;"
                                                 tabindex="-1">

                                         @if($project->State =='Closed')
                                            <option value='{{  $project->State }}'>{{  $project->State }}</option>


                                            <option>Open</option>
                                            <option>Completed</option>
                                            <option>Released</option>


                                        @endif
                                        @if($project->State =='Open')
                                            <option value='{{  $project->State }}'>{{  $project->State }}</option>


                                                 <option>Closed</option>
                                                 <option>Completed</option>
                                                 <option>Released</option>

                                        @endif

                                             @if($project->State =='Completed')
                                                 <option value='{{  $project->State }}'>{{  $project->State }}</option>


                                                 <option>Closed</option>
                                                 <option>Open</option>
                                                 <option>Released</option>

                                             @endif

                                        @if($project->State =='Released')
                                            <option value='{{  $project->State }}'>{{  $project->State }}</option>


                                                 <option>Closed</option>
                                                 <option>Completed</option>
                                                 <option>Open</option>
                                        @endif


                                             }
                                    </select>
                                </div>



                                <div class="form-group">
                                    {!! Form::label('duration', 'Duration:', ['class' => 'control-label']) !!}
                                    {!! Form::text('duration', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                </div>



                                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}

                                    <br>

                            </div>
                        </div>
                    </div>

<br>
          </div>
    </div>
    </div>
@endsection



