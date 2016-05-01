
@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>

@section('content')
    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Create New Idea</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

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
                                <?php
                                use Illuminate\Support\Facades\DB as DB;
                                use App\Http\Controllers\IdeaController;

                                $pms=DB::table('assign_projects')->where('ProjectManager',Auth::user()->name)->get();

                                foreach($pms as $key => $pm){
                                    $id= $pm->ProjectName;

                                    $idea_id=IdeaController::generateIdeaID($id);


                                }

                                ?>

                                {!! Form::open(['route' => 'ideas.store']) !!}



                                <div class="form-group">
                                    {!! Form::label('project_id', 'Project ID:', ['class' => 'control-label']) !!}
                                    {!! Form::text('project_id', $id , ['class' => 'form-control' , 'style' => 'width:50%;','readonly'=>'true']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('idea_id', 'Idea ID:', ['class' => 'control-label']) !!}
                                    {!! Form::text('idea_id',$idea_id , ['class' => 'form-control' , 'style' => 'width:50%;','readonly'=>'true']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'style' => 'width:50%;','size' => '20x3']) !!}
                                </div>


                                <div class="form-group">
                                    {!! Form::label('priority', 'Priority:', ['class' => 'control-label']) !!}
                                    <select class="form-control " name="priority" style="width: 50%"
                                    >
                                        <?php

                                        echo "<option >High</option >";
                                        echo "<option >Medium</option >";
                                        echo "<option >Low</option >";



                                        ?>
                                    </select>
                                </div>




                                {!! Form::submit('Create Idea', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
