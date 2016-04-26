@extends('app')

<?php
use \App\User;
?>

@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>



@endsection


@section('content')

    <div class="container">


        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif





        <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
            <div class="box-header with-border">

                <div class="panel panel-info">

                    <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                        <div class="form-group" >

                            <h1 style="height: 80px;"><b>TEAMS
                                    <a class="btn btn-small btn-info pull-right" href="{{ URL::to('teams/create') }}"><i class='glyphicon glyphicon-plus'> </i> Add New Team</a>

                                    <a  class="btn  pull-right " style="width: 50px"> </a>

                                    <a class="btn btn-small btn-info pull-right" href="{{ URL::to('assign_teams/create') }}"><i class='glyphicon glyphicon-user'> </i> Assign Teams</a>
                                </b></h1>









                        </div>
                    </div>

                </div>



                <div class="col-md-11" style="background-color:  #7adddd">

<br>



        <table class="table table-striped " id="myTable">



            <thead style="background-color:#3c8dbc">
            <tr style="color: #eff7ff ;font-weight: 900">

                <td>Team Name</td>
                <td> Developers</td>
                <td>Assigned States</td>
                <td>Show/Edit/Delete</td>
            </tr>
            </thead>

            <tbody>
            @foreach( $teams as $key =>  $team)

                <?php

                $devs = DB::table('dev_team')->where('team_id', $team->team_id)->get();


                $users = User::where('designation', 'Developer')->get();

                $user_id_name = array();

                foreach ($users as $user) {
                    $user_id_name[$user->id] = $user->name;
                }
                ?>

                <tr>

                    <td>{{ $team->TeamName}}</td>
                    <td>

                        <?php
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


                        @if( $team->assigned_state=='no')

                            <td> <span class="label label-success">{{  $team->assigned_state }}</span></td>


                        @elseif( $team->assigned_state=='assigned')

                            <td> <span class="label label-warning">{{  $team->assigned_state }}</span></td>



                        @endif




                    <td>

                        <a class="btn btn-small btn-info" style="background-color: #5b9909"
                           href="{{ URL::to('teams/' . $team->team_id) }}"><i class='glyphicon glyphicon-eye-open'></i> Show</a>

                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('teams/' . $team->team_id . '/edit') }}">
                            <i class='glyphicon glyphicon-edit'> </i> Edit </a>


                        <a class="btn btn-small btn-info bg-red-active glyphicon glyphicon-trash"
                           href="#" data-toggle="modal"
                           data-target="#delete"> Delete</a>

                        <div id="delete" class="modal fade" role="dialog">
                            <div class="modal-dialog" >
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#337ab7">
                                        <!-- Modal buuton to close form-->
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" style="color: white"><b>Confirmation Box</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <section class="content">
                                            <div class="box box-default">
                                                <div class="box-header with-border">
                                                    <!-- route to store method in controller to store data-->




                                                    {!! Form::model( $team, [ 'method' => 'DELETE', 'route' => ['teams.destroy',$team->team_id] ,'class'=>'delete']) !!}

                                                        <h1>Do you really want to delete this?</h1>

                                                    <button class='btn btn-danger' type='submit' id="btnDelete"  >

                                                        <i class='glyphicon glyphicon-trash'></i> Delete

                                                    </button>


                                                    {!! Form::close() !!}




                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>



    </div>

        <br>
    </div><br>
</div>
        </div>



@endsection

@section('page_script2')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <!--<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>-->

    <!--load search/sort functionality on table-->
    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>








@endsection








