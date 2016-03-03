@extends('app')
<?php
use \App\User;
?>
@section('content')
    <br/>
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <br/>
                <h1 style="color: #00a157">Editing Teams</h1>
                <h2 style="color: #00a65a">{{  $team->TeamName}}</h2>

                <p class="lead">Edit and save this Team below, or <a href="{{ route('teams.index') }}">Go back to all
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

                <div class="col-md-6" style="background-color: #99ee99">
                    <br>
                {!! Form::model( $team, [
                'method' => 'PATCH',
                'route' => ['teams.update',$team->team_id]
            ]) !!}

                <div class="form-group">
                    {!! Form::label('TeamName', 'Team Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('TeamName', null, ['class' => 'form-control','style' => 'width:50%;']) !!}
                </div>


                <div class="form-group">




                        <label>Developers</label>
                        <br>
                          <?php


                            $devs = DB::table('dev_team')->where('team_id', $team->team_id)->get();

                            $users = User::where('designation', 'Developer')->get();

                            $user_ids = array();
                            foreach ($devs as $dev) {
                                array_push($user_ids, $dev->user_id);
                            }

                            $user_id_assigned = array();
                            foreach ($users as $user) {
                                if (in_array($user->id, $user_ids)) {
                                    $user_id_assigned[$user->id] = "checked";
                                } else {
                                    $user_id_assigned[$user->id] = "";
                                }
                            }
                            ?>


                        @foreach ($users as $user)
                            <input tabindex="1" type="checkbox" name="users[]" id="{{$user->id}}"
                                   value="{{$user->id}}" <?php echo strcmp($user_id_assigned[$user->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$user->name}}
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
@endsection

