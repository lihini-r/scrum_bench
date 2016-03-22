@extends('app')

<?php
use \App\User;
?>

@section('content')

    <div class="container">
        <div class="box box-default">

            <div class="box-header with-border">


                <p >Edit and save this Team below, or <a href="{{ route('teams.index') }}">Go back to all
                        Teams</a></p>


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

                                <h1 style="color: #00a157">Editing Teams</h1>


                            </div>

                        </div>



                        <div class="col-md-6" style="background-color: #7adddd">
                    <br>

                {!! Form::model( $team, [ 'method' => 'PATCH', 'route' => ['teams.update',$team->team_id]  ]) !!}

                    <div class="form-group">
                        {!! Form::label('TeamName', 'Team Name:', ['class' => 'control-label']) !!}
                        {!! Form::text('TeamName', null, ['class' => 'form-control','style' => 'width:50%;']) !!}
                    </div>



                    <div class="form-group">


                        <label>Developers</label>
                        <br>
                          <?php

                          //get already assigned developers

                            $devs = DB::table('dev_team')->where('team_id', $team->team_id)->get();

                           //get  developers in system

                            $users = User::where('designation', 'Developer')->get();

                            //create array $user_ids to insert already assignes user_id

                            $user_ids = array();
                            foreach ($devs as $dev) {
                                array_push($user_ids, $dev->user_id);
                            }

                            //create array $user_id assigned

                            $user_id_assigned = array();

                            //compare user ids of user table and user ids of assigned in $user_ids array

                            foreach ($users as $user) {
                                if (in_array($user->id, $user_ids)) {


                                    $user_id_assigned[$user->id] = "checked";
                                } else {

                                    $user_id_assigned[$user->id] = "";
                                }
                            }
                            ?>

                            <!-- get user id of user table and check whether it is "checked"
                            if checked mark 'checked' attribute as "checked"  on checkbox
                            else mark as null-->

                            <!-- mark assigned developers and display available ones as unchecked-->

                        @foreach ($users as $user)
                            <input tabindex="1" type="checkbox" name="users[]" id="{{$user->id}}"
                                   value="{{$user->id}}"
                            <?php echo strcmp($user_id_assigned[$user->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$user->name}}
                            <br/>
                        @endforeach


                   </div>




                   <div class="form-group">
                    {!! Form::label('assigned_state', ' Assigned State:', ['class' => 'control-label']) !!}
                    {!! Form::text('assigned_state', null, ['class' => 'form-control','style' => 'width:50%;','readonly'=>'true']) !!}
                   </div>


                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
<br>
            </div>
        </div>
    </div>


    </div>
        </div>
    </div>
@endsection

