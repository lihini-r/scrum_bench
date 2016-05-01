@extends('app')


@section('content')

    <div class="container">


        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif



        <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
            <div class="box-header with-border">

                <div class="panel panel-info">

                    <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                        <div class="form-group" >

                            <h1 style="height: 80px;"><b>RELEASE BACKLOG</b></h1>


                        </div>
                    </div>
                </div>






<div class="col-md-11">

<div class="col-md-5 ">

<div class="row">

<!-- VIEW RELEASED PROJECTS-->

    <div class="box box-default" style="background-color: #8fdf82">
        <div class="box-header with-border bg-green-active">
            <h3 class="box-title" >Released Projects</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">


            <?php

            $rel_pro =array();
            //$released_projects=\Illuminate\Support\Facades\DB::table('projects')->where('State','Released')->get();

            foreach($projects as $released_project){

                array_push($rel_pro,$released_project->ProjectName);

            }

            $arrlength = count($rel_pro);
            for($x = 0; $x < $arrlength; $x++) {


                echo "
                <div class='info-box bg-olive'>
                <span class='info-box-icon'>
                <i class='fa fa-comments-o'></i></span>
                <div class='info-box-content'>
                  <span class='info-box-text'></span>";



                echo "<span class='info-box-number'>$rel_pro[$x] </span>";
                echo "<div class='progress'>
                <div class='progress-bar' style='width: 70%'></div>
            </div>
    <span class='progress-description'>

    </span></div><!-- /.info-box-content -->
    </div><!-- /.info-box -->";


            }



            ?>
        </div></div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->




    <!--VIEW CLOSED PROJECTS-->

    <div class="col-md-5">

                   <div class="box box-default collapsed-box">
                        <div class="box-header with-border bg-yellow-gradient">
                            <h3 class="box-title">Completed Projects</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body" style="background-color: #FFD34F">

                            @foreach($pname as $pnam)



                                    <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{$pnam -> ProjectName}}</span>
                                    <span class="info-box-number">  ProjectID :{{$pnam ->ProjectID}}
                                </span>
                                    <!-- The progress section is optional -->
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">

                                    </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->




                                <br>


                            @endforeach




</div>


</div>


        <a class="btn btn-small btn-success pull-right glyphicon-plus"
           href="#" data-toggle="modal"
           data-target="#release">Release</a>



        <div id="release" class="modal fade" role="dialog">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#337ab7">
                        <!-- Modal buuton to close form-->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: white"><b>Release</b></h4>
                    </div>
                    <div class="modal-body">
                        <section class="content">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <!-- route to store method in controller to store data-->




                                    {!! Form::open(['route' => 'release_backlog.store']) !!}



                                    <div class="form-group">

                                        <b>  Project Name</b>



                                        <select class="form-control select2 select2-hidden-accessible" name="ProjectName" style='width: 50%;'
                                                tabindex="-1"
                                                aria-hidden="true" >



                                            @foreach(	$pname as 	$pro_name)




                                                <option value = "{{$pro_name->ProjectName}}"> {{$pro_name->ProjectName}}</option >





                                            @endforeach

                                        </select>

                                    </div>




                                    <div class="form-group"><b>Release Date</b>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <input class="form-control" type="text" data-mask="" name="release_date"
                                                   data-inputmask="'alias': 'yyyy-mm-dd'"
                                                   style="width: 48.5%;"/>
                                        </div>
                                    </div>


                                    <div class="form-group">

                                  <!--      <b>  Account Name</b>-->


                                            @foreach(	$pname as 	$pro_name)


                                            <input type="text"  hidden name="acc_name" value="{{$pro_name->acc_name}}">

                                            @endforeach


                                    </div>




                                    {!! Form::submit('Release Project', ['class' => 'btn btn-primary']) !!}



                                    {!! Form::close() !!}



                                    <script>


                                        $(function () {
                                            //Datemask dd/mm/yyyy
                                            $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
                                            //Datemask2 mm/dd/yyyy
                                            $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
                                            //Money Euro
                                            $("[data-mask]").inputmask();
                                        });




                                    </script>



                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>




    </div><!-- /.box-body -->

</div><!-- /.box -->




            </div>

</div>
    </div>
@endsection