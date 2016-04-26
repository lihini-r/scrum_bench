<!--add new projects-->

@extends('app')

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">


        <a href="{{ route('projects.index') }}">Go back to all Projects</a></p>

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

                     <h1 style="color: #00a157">Add New Project</h1>

                 </div>

             </div>



        <div class="col-md-7" style="background-color:  #7adddd">
            <br>


            {!! Form::open(['route' => 'projects.store'])!!}



            <!--get account name-->
                    <div class="form-group">

                        <div class="form-group" >
                            @foreach($account as $key => $acc)


                            <b>Account Name</b><input  readonly class="form-control" name="acc_name" type="text" value="{{$acc->acc_name}}" placeholder="Enter Project Name"
                                               style="width: 50%;" type="number"/>

                            @endforeach
                        </div>

                    </div>

            <!--get account id as hidden field-->
                      <div class="form-group">

                        <div class="form-group" >
                            @foreach($account as $key => $acc)
                                <!--Account ID-->
                                <b></b><input  readonly class="form-control" name="id" type="hidden" value="{{$acc->id}}"
                                                           style="width: 50%;" type="number"/>

                            @endforeach
                        </div>

                    </div>

            <!--get project name-->


                    <div class="form-group">

                        <div class="form-group">
                           <b> Project Name</b><input class="form-control" name="ProjectName" type="text" placeholder="Enter Project Name"
                                               style="width: 50%;" type="number"/>
                        </div>

                    </div>

            <!--get project description-->

                    <div class="form-group">
                        <b> Description</b><textarea class="form-control" placeholder="Enter ..." rows="3" name="Description" style="width: 50%;"
                                             tabindex="2"></textarea>
                    </div>
            <!--get project state-->

                    <div class="form-group">
                        <div class="form-group">
                            <b> State</b><input class="form-control" name="State" type="text" value="Closed" readonly
                                                   style="width: 50%;" type="number"/>
                        </div>

                    </div>

            <!--get project duration-->

                    <div class="form-group">

                        <div class="form-group">
                            <b> Duration</b><input class="form-control" name="duration" type="text" placeholder="months"
                                                       style="width: 50%;" type="number"/>
                        </div>

                    </div>




            {!! Form::submit('Add Project', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}


            <br>

        </div>


         </div>
            <br>

        </div>
    </div>
<br>


@endsection
