@extends('app')


@section('content')
<br/>
<br/>
<br/>
<div class="container">


    <h1 style="color: #00a157">Assign Project Managers</h1>

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


<div class="col-md-6" style="background-color: #99ee99">

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

        <b>Project Name</b><select class="form-control select2 select2-hidden-accessible" name="ProjectName" style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
            <?php

                $results=DB::table('projects')->get();

            foreach ($results as $result) {
                $prj_id = $result->ProjectID;
                $prj_name=$result->ProjectName;
                $ste = $result->State;

                echo "<option value = '$prj_name'> $prj_name</option >";
            }
            ?>
        </select>
</div>


    <div class="form-group">

       <b> Select Project Manager</b> <select class="form-control select2 select2-hidden-accessible" name="ProjectManager" style="width: 50%;"
                                  tabindex="-1"
                                  aria-hidden="true" >
            <?php

            $results=DB::table('users')->where('designation','Project Manager')->get();


            foreach ($results as $result) {

                $id = $result->id;
                $name=$result->name;
                $ste = $result->designation;

                echo "<option  value = '$name' >$name</option >";
            }
            ?>
        </select>
    </div>




    {!! Form::submit('Assign Project', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    <br>
</div>

<br>
</div>


@endsection