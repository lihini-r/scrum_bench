@extends('app')

<?php
use \App\User;
?>
@section('content')
    <br/>
    <div class="form-group" style="padding:20px 30px 20px 20px;">
        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('teams/create') }}">Add New Team</a>


    </div>
    <br/>
    <br/>
    <div class="container">


        <div class="col-md-11" style="background-color:  lightgreen">

<br>

        <table class="table table-striped " id="myTable">


            <!--   <table class="table table-striped " >-->

            <thead style="background-color:mediumseagreen">
            <tr>

                <td>Team Name</td>
                <td> Developers</td>
                <td>Assigned States</td>
                <td>Show/Edit</td>
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
                                    echo ", ";
                                }
                                echo $user_id_name[$dev->user_id];
                                $count++;
                            }
                        ?>
                    </td>
                    <td>{{  $team->assigned_state }}</td>


                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <a class="btn btn-small btn-info" style="background-color: #5b9909"
                           href="{{ URL::to('teams/' . $team->team_id) }}">Show</a>

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('teams/' . $team->team_id . '/edit') }}">Edit </a>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

        <br>
    </div>

    @section('page_script2')
            <!--script type="text/javascript"
            src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script-->

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>
@endsection







@endsection




