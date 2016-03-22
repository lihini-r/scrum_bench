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
                                     <a class="btn btn-small btn-info pull-right" href="{{ URL::to('projects/create') }}">Add New Project</a>

                                     @foreach($account as $key => $acc)

                                         <h1 ><b>{{$acc->acc_name}}</b></h1>

                                     @endforeach

                                 </div>


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



                                        @endif





                                            <td>{{  $project->duration }}   months</td>





                                        <td>


                                            <a class="btn btn-small btn-info" style="background-color: #5b9909" href="{{ URL::to('projects/' . $project->ProjectID) }}">Show</a>

                                            <a class="btn btn-small btn-info" style="background-color: #005384" href="{{ URL::to('projects/' . $project->ProjectID . '/edit') }}">Edit </a>

                                            <a class="btn btn-small btn-info" href="{{ URL::to('hide/' . $project->ProjectID . '/edit') }}">Hide </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    <br>

             </div>



                     </div></div>
@section('page_script2')

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