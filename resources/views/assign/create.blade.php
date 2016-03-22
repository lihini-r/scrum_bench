@extends('app')


@section('content')
<br/>
<br/>
<br/>
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

                                    <h1 style="color: #00a157">Assign Project Managers</h1>
                                </div>

                            </div>





            <div class="col-md-6" style="background-color: #7adddd">

                        <br>
                        {!! Form::open(['route' => 'assign.store']) !!}

                        <div class="form-group">


                            <div class="form-group">
                                @foreach($account as $key => $acc)


                                  <b>  Account Name</b><input  readonly class="form-control" name="acc_name" type="text" value="{{$acc->acc_name}}" placeholder="Enter Project Name"
                                                        style="width: 50%;" type="number"/>

                                @endforeach
                            </div>

                        </div>

                        <div class="form-group">

                            @foreach($account as $key => $acc)


                                <b>Project Name</b>


                                <?php
                                    $pid=array();
                                    $assigned=\App\AssignProjects::all();


                                         foreach($assigned as $assi)
                                             {
                                                 array_push($pid,$assi->ProjectName);

                                             }



                                    $res=$acc->acc_name;
                                    $results=\App\Project::where('acc_name',$res)->get();



                                echo "<select
                                class='form-control select2 select2-hidden-accessible' name='ProjectName' style='width: 50%;'
                                tabindex='-1'
                                aria-hidden='true'>";

                                foreach($results as $res){

                                    $pname=$res->ProjectName;

                                   if (in_array($res->ProjectID,$pid)){



                                   }
                                    else{

                                        echo "<option value = '$res->ProjectID'> $pname</option >";

                                    }

                                }

                                echo " </select>";



                                ?>

                                    @endforeach

                        </div>


                        <div class="form-group">

                           <b> Select Project Manager</b>
                                   <?php

                                $unames=array();
                                $assigned_pm=\App\AssignProjects::all();



                                foreach( $assigned_pm as $pm)
                                {
                                    array_push($unames,$pm->ProjectManager);


                                }


                                echo "<select class='form-control select2 select2-hidden-accessible' name='ProjectManager' style='width: 50%;'
                                                      tabindex='-1'
                                                      aria-hidden='true' >";


                                $results=DB::table('users')->where('designation','Project Manager')->get();

                                foreach( $results as $result)
                                {

                                    $name=$result->name;
                                    if (in_array($name,$unames)){



                                    }
                                    else{

                                        echo "<option value = '$name'> $name</option >";

                                    }



                                }



                               echo "</select>";


                                ?>

                        </div>




                        {!! Form::submit('Assign Project', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}
                        <br>
                    </div>

                    <br>
                    </div>
</div>
    </div>

@endsection