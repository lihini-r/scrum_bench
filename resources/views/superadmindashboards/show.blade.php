
@extends('app')





@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container"> <div style="width:80%;padding:5px 5px 15px 80px;">
            <div class="panel panel-info" >
                <div class="panel-heading"><h1>Project P{{ $project->ProjectID }}</h1></div>

                <div class="panel-body">

                    <div class="panel-body">


                        <ul>




                        </ul>
                        <div class="modal-content" style="background: #81DAF5 ;  ">
                            <div class="modal-header">

                                <h4 class="modal-title"> Project Name : {{ $project->ProjectName }}</h4>
                            </div>
                            <div class="modal-body" >

                                </br>
                                <?php
                                use App\Http\Controllers\AccountController;
                                $progress=AccountController::showProjectProgress($project->ProjectID);
                                echo"$progress";
                                ?>



                            </div>
                            <div class="modal-footer">
                                <h4 class="modal-title" align="left"> Technologies : {{ $project->Description }}</h4>
                                <h4 class="modal-title" align="left"> Duration : {{ $project->duration }} Months</h4>
                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection