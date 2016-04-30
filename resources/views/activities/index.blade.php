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
                        <div class="panel-heading"><h1>Activity Log</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

                                <table class="table table-striped " id="myTable">
                                    <thead style="background-color: #3c8dbc">
                                    <tr style="font-weight: 900 ;color: #eff7ff">
                                        <td>ID</td>
                                        <td>User ID</td>
                                        <td>Description</td>
                                        <td>Time</td>
                                        <td>Delete</td>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latestActivities as $key => $activity)
                                        <tr>
                                            <td>{{ $activity->id }}</td>
                                            <td>{{ $activity->user_id }}</td>
                                            <td>{{ $activity->text}}</td>
                                            <td>{{ $activity->created_at }}</td>
                                            <td>
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


                                                {!! Form::model( $activity, [ 'method' => 'DELETE', 'route' => ['activities.destroy',$activity->id],'onsubmit' => 'return ConfirmDelete()' ,'class'=>'delete']) !!}

                                                <button class='btn btn-danger' type='submit' id="btnDelete" >Delete





                                                </button>

                                                {!! Form::close() !!}





                                            </td>


                                            <!-- we will also add show, edit, and delete buttons -->

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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



    <script src="{{ URL::asset('plugins/chart/jquery.chart.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {


            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#sprint-del-frm').submit();
                }
            });
        });
    </script>
@endsection