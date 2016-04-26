
@extends('app')
<?php
use \App\User;
?>

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">



        <a href="{{ route('teams.index') }}">Go back to all Teams</a></p>



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

                        <h1 style="color: #00a157">Add New Team</h1>

                    </div>

                </div>



                <div class="col-md-6" style="background-color:#7adddd">

            <br>

        {!! Form::open(['route' => 'teams.store']) !!}

                    <!--get team name-->

                 <div class="form-group">
                    {!! Form::label('TeamName', 'Team Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('TeamName', null, ['class' => 'form-control' , 'style' => 'width:50%;']) !!}
                 </div>


                    <!--assign developers to team-->

                    <div class="form-group">
                        <label>Select Developers</label>
                        <br>

                        <?php

                        //get unassigned developers

                        $assi_ids =array();

                        $assdiv=DB::table('dev_team')->get();

                        foreach($assdiv as $item)
                        {
                            array_push($assi_ids, $item->user_id);
                        }

                        $users1 = User::where('designation','Developer')->get();


                        foreach($users1 as $user)
                        {

                            $uname=$user->name;



                            if (in_array($user->id, $assi_ids)) {


                            } else {



                                $users[$user->id]=$user->id;



                              //  array_push($team,  $teams[$t->team_id]);


                                $id=$users[$user->id];

                                echo "<input tabindex='1' type='checkbox' name='users[]' id='$id' value='$id' /> ";



                                echo $uname;
                                echo "<br>";
                            }

                        }









                        ?>




                    </div>














                    {!! Form::submit('Create Team', ['class' => 'btn btn-primary']) !!}



            {!! Form::close() !!}

            <br>
    </div>

    </div>
        </div>
    </div>


@endsection

