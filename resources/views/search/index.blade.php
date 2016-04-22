
@extends('app')

@section('content')
    <div class="container">

        <div class="container">
            <div class="box box-default">

                <div class="box-header with-border">




                    <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
                        <div class="box-header with-border">

                            <div class="panel panel-info">

                                <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                                    <h1 style="color: #00a157">Search Results</h1>


                                </div>

                            </div>

                      </div>
                    </div>


<div class="col-md-7">



                            @foreach($search as $s)
        <div class="box box-default">
            <div class="box-header with-border bg-light-blue-gradient">
                <h3 class="box-title">Results</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body bg-teal-gradient">

                                <ul>
                                    <li>Account Name :{{$s->acc_name}}</li>
                                    <li>ProjectID :{{$s->default}}{{$s->ProjectID}}</li>
                                    <li>Project Name :{{$s->ProjectName}}</li>

                                    <li>Project Description :{{$s->Description}}</li>

                                    <li>Project state : {{$s->State}} </li>

                                    <li>Duration : {{$s->duration}} </li>

                                </ul>

            </div>
        </div>
                            @endforeach


                            @foreach($search1 as $s1)

                    <div class="box box-default">
                        <div class="box-header with-border bg-green-gradient">
                            <h3 class="box-title ">Results</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body bg-olive">

                                <ul>

                                    <li>Project ID : {{$s1->project_id}}</li>
                                    <li>User Story :{{$s1->summary}}</li>
                                    <li>User Story ID :{{$s1->story_id}}

                                    <li>Description : {{$s1->description}} </li>



                                    <li>Priority :{{$s1->priority}}</li>

                                    <li>Due Date :{{$s1->due_date}}</li>


                                    <li>Estimated Time : {{$s1->org_est}} </li>

                                    <li>Visibility: {{$s1->visibility}} </li>

                                    <li>Project Manager: {{$s1->reporter}} </li>
                                </ul>

                        </div>
                    </div>
                            @endforeach







                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

</div>

                </div></div></div>
    </div>
@endsection