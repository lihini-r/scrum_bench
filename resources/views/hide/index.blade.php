
<!--PROJECT MANAGER DASHBOARD-->

@extends('app')

<?php

use Illuminate\Support\Facades\DB as DB;




?>




@section('content')
    <br/>

    <div class="container">


            <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
                <div class="box-header with-border">

                    <div class="panel panel-info">

                        <div class="panel-heading" >

                            <div class="form-group" >

                                @foreach($projects as $key =>$pm)

                                    <h1 style="color: #00a65a" ><b>{{$pm->ProjectName}} Project</b></h1>

                                @endforeach
                                </div>

                            </div>

                    </div>

                    <div class="panel panel-info">
                        <div class="panel-heading"></div>

                        <div class="panel-body">
                            <div class="col-md-11" style="background-color: #99ee99">

                            <div style="background-color: #99ee99">
                                <br>
                    <table class="table table-striped" style="background-color: #ddffdd">

                        <tbody>





                        @foreach($projects as $key =>$pro)

                            <tr><td style="color: #ca195a ; font-weight: 700 ;">Account Name</td>
                                <td style="color: #001a35; font-weight: 700 ;">{{ $pro->acc_name }}</td></tr>


                            <tr><td style="color: #ca195a ; font-weight: 700 ;">Description</td>
                            <td style="color: #001a35; font-weight: 700 ;">{{$pro->Description }}</td></tr>

                        <tr><td style="color: #ca195a ; font-weight: 700 ;"> State</td>
                            <td style="color: #001a35; font-weight: 700 ;">{{ $pro->State }}</td></tr>


                        <tr><td style="color: #ca195a ; font-weight: 700 ;"> Duration</td>
                            <td style="color: #001a35; font-weight: 700 ;">{{ $pro->duration }} months</td></tr>


                        @endforeach

                        </tbody>
                    </table>

                   </div>




                            </div>
                </div>

                </div>
                <br> <br>





        <!--Display Teams-->

                    <div class="panel panel-info">

                        <div class="panel-heading" >

                            <div class="form-group" >


                                    <h1 style="color: #00a65a" ><b>Assigned Teams</b></h1>


                            </div>

                        </div>

                    </div>

        <div class="col-md-12">
            <div class="row">



                    @foreach($projectids as $key =>$pids)


                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">

                            <div class="inner">

                                <?php

                                $tid=$pids->team_id;

                                $teamnames = DB::table('teams')->where('team_id', $tid)->get();

                                foreach($teamnames as $tn)

                                    echo "<h1>$tn->TeamName</h1>";

                                ?>

                                   <h3>{{ $pids->team_id }}</h3>
                            </div>


                            <div class="icon">
                                    <i class="ion ion-person-add"></i>
                            </div>
                                   <a class="small-box-footer" href="{{ URL::to('hide/' . $pids->team_id) }}">
                                    More Info..
                                   <i class="fa fa-arrow-circle-right"></i>
                                   </a>

                        </div>

                    </div>


                @endforeach

            </div>

        </div>

                </div>



            </div>
    </div>

@endsection

