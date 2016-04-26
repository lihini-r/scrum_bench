<!--view team details in pm dashboard--->

@extends('app')
<?php
use \App\User;
?>
@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">
        <a href="{{ route('hide.index') }}">Go back to Dashboard</a></p>




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













            <div class="row">

            <!--view developer profiles-->


                    <?php
                    $devs=DB::table('dev_team')->where('team_id',$team->team_id)->get();
                    $users = User::where('designation','Developer')->get();


                    $user_id_name = array();
                    foreach($users as $user){
                        $user_id_name[$user->id] = $user->name;


                    }
                    ?>

                    <?php




                    foreach ($devs as $dev) {



                        $profile=DB::table('profiles')->where('id',$dev->user_id)->get();

                        foreach($profile as $pro)
                        {
                          echo " <div class='col-md-4'>";


                            echo "<div class='box box-widget widget-user-2'>
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class='widget-user-header bg-green-active'>
            <div class='widget-user-image'>
                 <img class='img-circle' src='../../../dist/img/pm.png'>
            </div><!-- /.widget-user-image -->";


                            $name=$user_id_name[$dev->user_id];
                            echo " <h3 class='widget-user-username'>$name</h3>";
                            //echo $user_id_name[$dev->user_id];

                            echo "<br>";
                            echo " <h5 class='widget-user-desc'>$pro->about</h5>";


                            echo  "<div class='box-footer no-padding'>
                <ul class='nav nav-stacked'>
                    <li><a href='#'>Professional Qualifications <span class='pull-right badge bg-red'>$pro->prof_qual</span></a></li>
                    <li><a href='#'>Academic Qualifications <span class='pull-right badge bg-aqua'>$pro->acad_qual</span></a></li>
                    <li><a href='#'>Technology <span class='pull-right badge bg-yellow-active'>$pro->techno</span></a></li>

                </ul>
                                    </div>";

                            echo " </div>";
                            echo " </div>";
                            echo " </div>";


                        }







                    }

                    ?>

                </div>
        </div>

            </div>



        <!-- /.widget-user -->














@endsection



