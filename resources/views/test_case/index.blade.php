@extends('app')



@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>



@endsection









@section('content')


    <div class="container">

        <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
            <div class="box-header with-border">

                <div class="panel panel-info">

                    <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                        <div class="form-group" >

                            <h1 style="height: 80px;"><b>TEST LODGE
                                 </b>





                                <a class="btn btn-small btn-info pull-right" href="{{ URL::to('test_case/create') }}"><i class='glyphicon glyphicon-plus'> </i> Create Test Case</a>





                            </h1>

                        </div>
                    </div>

                </div>



                <div class="col-md-12" style="background-color:  #7adddd">

                    <br>



                    <table class="table table-responsive " id="myTable">



                        <thead style="background-color:#3c8dbc">
                        <tr style="color: #eff7ff ;font-weight: 900">

                            <td>TestCase
                                ID</td>
                            <td>TestCase
                                Name</td>
                            <td>Scenario</td>
                            <td>Test
                                Steps</td>
                            <td>Expected
                                Outcome</td>
                            <td >Actual
                                Outcome</td>
                            <td>Pass_Fail</td>
                            <td>Comments</td>
                            <td>Edit/Delete</td>


            </tr>
            </thead>
            <tbody>

            @foreach($test as $te)

                <tr>

                    <td>T {{$te-> TestCaseID}}</td>
                    <td>  {{$te->TestCaseName}}</td>
                    <td>  {{$te->Scenario}}</td>
                     <td >{{$te->TestSteps}} </td>
                    <td>  {{$te->ExpectedOutcome}}</td>
                    <td >  <span class="label label-success">{{$te->ActualOutcome}}</span> </td>
                    <td > <span class="label label-warning">{{$te->Pass_Fail}}</span>  </td>
                    <td> <span class="label bg-maroon-gradient">{{$te->Comments}}</span></td>
                    <td>




                        <a class="btn btn-small btn-info" href="{{ URL::to('test_case/' . $te->TestCaseID . '/edit') }}">
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




                                                    {!! Form::model( $te, [ 'method' => 'DELETE', 'route' => ['test_case.destroy',$te->TestCaseID],'class'=>'delete' ]) !!}

                                                    <h1>Do you really want to delete this?</h1>

                                                    <button class='btn btn-danger' type='submit' id="btnDelete" >

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
</div>
        </div>
    </div>






@endsection



@section('page_script2')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <!--<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>-->
    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>








@endsection







