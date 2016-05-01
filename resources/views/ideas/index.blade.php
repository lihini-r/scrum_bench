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


    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Ideas Backlog</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

                                <div class="form-group" style="padding:20px 30px 20px 20px;">
                                    <a class="btn btn-small btn-info pull-right" href="{{ URL::to('ideas/create') }}">Create New Idea</a>
                                </div>

                                </br>

                                <table class="table table-striped " id="myTable">
                                    <thead style="background-color: #3c8dbc">
                                    <tr style="font-weight: 900 ;color: #eff7ff">


                                        <td width="75">Idea ID</td>
                                        <td width="75">Project ID</td>
                                        <td width="180">Title</td>

                                        <td width="100">Priority</td>
                                        <td>Show / Edit </td>


                                    </tr>
                                    </thead>
                                    <tbody>



                                    @foreach($ideas as $key => $idea)
                                        <?php
                                        $color=\App\Http\Controllers\IdeaController::getBadgeColour($idea->priority);
                                        ?>

                                        <tr>
                                            <td>{{ $idea->idea_id }}</td>
                                            <td>{{ $idea->project_id }}</td>
                                            <td>{{ $idea->title }}</td>
                                            @if($idea->priority==="High")
                                                <td><small class="label  bg-red">{{ $idea->priority }}</small></td>
                                            @elseif($idea->priority==="Medium")
                                                <td><small class="label  bg-orange">{{ $idea->priority }}</small></td>
                                            @elseif($idea->priority==="Low")
                                                <td><small class="label bg-green">{{ $idea->priority }}</small></td>
                                                @endif

                                                        <!-- we will also add show, edit, and delete buttons -->
                                                <td>

                                                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                                                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                    <script>

                                                        function ConfirmDelete()
                                                        {
                                                            var x = confirm("Are you sure you want to delete?");
                                                            if (x)
                                                                return true;
                                                            else
                                                                return false;
                                                        }

                                                    </script>


                                                    {!! Form::model( $idea, [ 'method' => 'DELETE', 'route' => ['ideas.destroy',$idea->idea_id],'onsubmit' => 'return ConfirmDelete()' ,'class'=>'delete']) !!}

                                                    <a class="btn btn-small btn-success" href="{{ URL::to('ideas/' . $idea->idea_id) }}">Show</a>

                                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <a class="btn btn-small btn-info" href="{{ URL::to('ideas/' . $idea->idea_id . '/edit') }}">Edit</a>



                                                    <button class='btn btn-danger' type='submit' id="btnDelete" >Delete





                                                    </button>

                                                    {!! Form::close() !!}


                                                </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div> </div></div></div></div></div></div>
    </div>
    @endsection

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

