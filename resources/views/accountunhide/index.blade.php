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
                        <div class="panel-heading"><h1>Hidden Accounts</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

                                <table class="table table-striped table-bordered" id="myTable">
                                    <thead style="background-color: #34cccd; color: white; font-size: 120%;">
                                    <tr>
                                        <td>ID</td>
                                        <td>Account Name</td>
                                        <td>Description</td>
                                        <td>Account Head</td>
                                        <td>Show / Edit</td>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accounts as $key => $account)
                                        @if($account->Hide==="on")
                                            <tr>
                                                <td>{{ $account->id }}</td>
                                                <td>{{ $account->acc_name }}</td>
                                                <td>{{ $account->description }}</td>
                                                <td>{{ $account->acc_head }}</td>


                                                <!-- we will also add show, edit, and delete buttons -->
                                                <td>


                                                    {!! Form::model($account, [ 'method' => 'POST',
                                                                                                    'route' => ['accountunhide.unhide', $account->id]]) !!}




                                                    {!! Form::submit('Unhide', ['class' => 'btn btn-primary']) !!}

                                                    {!! Form::close() !!}
                                                </td>
                                                @endif
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
@endsection

