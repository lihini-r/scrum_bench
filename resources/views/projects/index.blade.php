@extends('app')


@section('page_styles')

<link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>

@endsection



@section('content')
    <br/>



    <br/>
    <br/>

             <div class="container">

                 <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
                     <div class="box-header with-border">

                         <div class="panel panel-info">

                             <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                                 <div class="form-group" >


                                     @foreach($account as $key => $acc)

                                         <h1 ><b>{{$acc->acc_name}}</b></h1>

                                     @endforeach

                                 </div>






                         <div class="form-group" >


                         <a class="btn btn-small btn-info pull-right" href="{{ URL::to('projects/create') }}"><i class='glyphicon glyphicon-plus'> </i> Add New Project</a>



                         <a  class="btn  pull-right " style="width: 50px"> </a>

                         <a class="btn btn-small btn-info pull-right" href="{{ URL::to('assign_lead/create') }}"><i class='glyphicon glyphicon-user'> </i> Assign Project Leads</a>

                         <a  class="btn  pull-right " style="width: 50px"> </a>

                         <a class="btn btn-small btn-info pull-right" href="{{ URL::to('assign/create') }}"><i class='glyphicon glyphicon-user'> </i> Assign Project Managers</a>


                         <a  class="btn  pull-right " style="width: 50px"> </a>

                         <a class="btn btn-small btn-info pull-right" href="{{ url('/assign_teams') }}"><i class='glyphicon glyphicon-th-list'> </i> View with Hidden Projects</a>
                             <br><br>

                    </div>


                                 <hr>


                             </div>

                         </div>

                         <div class="col-md-11" style="background-color: #7adddd">
                            <br>


                           <table class="table table-striped " id="myTable" >


                                <thead style="background-color: #3c8dbc">
                                <tr style="font-weight: 900 ;color: #eff7ff">

                                <td>Project ID</td>
                                    <td>Project Name</td>
                                    <td> Description</td>
                                    <td>State</td>
                                    <td>Duration</td>
                                    <td>Show/Edit/Hide</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $projects as $key =>  $project)
                                    <tr>
                                        <td style="color: red">{{$project->default. $project->ProjectID }}</td>
                                        <td>{{  $project->ProjectName }}</td>
                                        <td>{{  $project->Description }}</td>


                                        @if($project->State=='Open')

                                            <td> <span class="label label-success">{{$project->State}}</span></td>


                                        @elseif($project->State=='Closed')

                                            <td> <span class="label label-info">{{$project->State}}</span></td>

                                        @elseif($project->State=='Released')

                                            <td> <span class="label label-warning">{{$project->State}}</span></td>

                                        @elseif($project->State=='Completed')

                                            <td> <span class="label bg-maroon-gradient">{{$project->State}}</span></td>



                                        @endif





                                            <td>{{  $project->duration }}   months</td>





                                        <td>


                                            <a class="btn btn-small btn-info" style="background-color: #5b9909" href="{{ URL::to('projects/' . $project->ProjectID) }}"><i class='glyphicon glyphicon-eye-open'></i> Show</a>

                                            <a class="btn btn-small btn-info" style="background-color: #005384" href="{{ URL::to('projects/' . $project->ProjectID . '/edit') }}"><i class='glyphicon glyphicon-edit'> </i> Edit </a>

                                            <a style="background-color: #8e57c2" class="btn btn-small btn-info" href="{{ URL::to('hide/' . $project->ProjectID . '/edit') }}"><i class='glyphicon glyphicon-eye-close'> </i> Hide </a>







                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    <br><br>

             </div>



                     </div></div>
@section('page_script2')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!--loading search function on datatable-->
    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>

@endsection



@endsection
