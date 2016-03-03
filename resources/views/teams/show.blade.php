
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


        <h1 style="color: #00a157">Team  : {{ $team->TeamName}}</h1>

        <div class="col-md-6" style="background-color: #99ee99">
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
                            echo ", ";
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




    </div> </div>
@endsection


