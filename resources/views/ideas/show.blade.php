@extends('app')
@section('content')
    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h3>  <b>{{ $idea->idea_id }}  </b></h3></div>
                        <div class="panel-body">

                            <div class="panel-body">
                                <table class="table table-striped table-bordered">
                                    <thead style="background-color: #6495ED;">

                                    <tr>
                                        <td><b>Project ID</b></td>
                                        <td><b>{{ $idea->project_id }}  </b></td>


                                    </tr>
                                    <tr>
                                        <td><b>Title</b></td>
                                        <td><b>{{ $idea->title }}  </b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Priority</b></td>
                                        <td><b>{{ $idea->priority }}  </b></td>



                                    </thead></table>

                                <table class="table table-striped table-bordered">
                                    <thead style="background-color: #6495ED;">
                                    <tr>
                                        <h5><b>  Description  </b></h5>

                                    </tr>
                                    <tr>
                                        <b> {{ $idea->description  }}</b>

                                    </tr>
                                    </thead></table>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection