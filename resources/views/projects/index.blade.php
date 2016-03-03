@extends('app')


@section('page_styles')
        <!--script type="text/javascript"
            src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script-->

<link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>

@endsection


@section('content')
    <br/>
    <div class="form-group" style="padding:20px 30px 20px 20px;">
        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('projects/create') }}">Add New Project</a>

        @foreach($account as $key => $acc)

        <h4 style="color: #00a65a" ><b>{{$acc->acc_name}}</b></h4>

            @endforeach

    </div>
    <br/>
    <br/>
    <div class="container">

        <div class="col-md-11" style="background-color:  lightgreen">
        <br>


       <table class="table table-striped " id="myTable" >


            <thead style="background-color: mediumseagreen">
            <tr>
                <td>Project ID</td>
                <td>Project Name</td>
                <td> Description</td>
                <td>State</td>
                <td>Added Date</td>
                <td>Due Date</td>
                <td>Show/Edit/Hide</td>
            </tr>
            </thead>
            <tbody>
            @foreach( $projects as $key =>  $project)
                <tr>
                    <td>{{$project->default. $project->ProjectID }}</td>
                    <td>{{  $project->ProjectName }}</td>
                    <td>{{  $project->Description }}</td>
                     <td>{{  $project->State }}</td>





                    <td>{{  $project->add_date }}</td>
                    <td>{{  $project->due_date }}</td>




                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <a class="btn btn-small btn-info" style="background-color: #5b9909" href="{{ URL::to('projects/' . $project->ProjectID) }}">Show</a>

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
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