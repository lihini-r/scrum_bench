
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




        <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
            <div class="box-header with-border">

                <div class="panel panel-info">

                    <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                        <h1 style="color: #00a157"> {{ $team->TeamName}}</h1>
                    </div>

                </div>



                <div class="panel panel-info">
                    <div class="panel-heading"></div>



                    <div class="panel-body">


                    <div class="col-md-6" style="background-color: #7adddd">
            <br>
        <table class="table table-striped" style="background-color: #ddffdd">

            <tbody>
            <tr><td>Team Name</td>
                <td>{{  $team->TeamName }}</td></tr>

            <tr><td>Developers</td>

                <?php
                $devs=DB::table('dev_team')->where('team_id',$team->team_id)->get();
                $users = User::where('designation','Developer')->get();
                $user_id_name = array();
                foreach($users as $user){
                    $user_id_name[$user->id] = $user->name;
                }
                        ?>
                <td> <?php
                    $count = 0;
                    foreach ($devs as $dev) {
                        if($count!=0){
                            echo "<br> ";
                        }
                        echo $user_id_name[$dev->user_id];
                        $count++;
                    }
                    ?>


                </td>

            </tr>

            <tr><td> State</td>
                <td>{{  $team->assigned_state }}</td></tr>

            </tbody>
        </table>




    </div>


            </div>
            <br>
        </div>
    </div>
        </div>
    </div>
@endsection


