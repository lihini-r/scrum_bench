@extends('app')

@section('content')

    <div class="container">



        <div class="box box-default">

            <div class="box-header with-border">


                <p >Edit and save this Test Case Below, or <a href="{{ route('test_case.index') }}">Go back to all
                        Test Cases</a></p>


                <hr>

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

                                <h1 style="color: #00a157">Editing Test Case</h1>


                            </div>

                        </div>



                        <div class="col-md-6" style="background-color: #7adddd">
                            <br>

                            {!! Form::model( $test, [ 'method' => 'PATCH', 'route' => ['test_case.update',$test->TestCaseID]  ]) !!}

                            <div class="form-group">
                                {!! Form::label('TestCaseID', 'Test Case ID:', ['class' => 'control-label']) !!}
                                {!! Form::text('TestCaseID', null, ['class' => 'form-control','style' => 'width:50%;','readonly'=>'true']) !!}
                            </div>




                            <div class="form-group">
                                {!! Form::label('ActualOutcome', ' Actual Outcome:', ['class' => 'control-label']) !!}

                                <input type="text" name="ActualOutcome" style="width: 50%" class="form-control">
                            </div>

                            <div class="form-group">
                                <b>Pass/Fail</b><select class="form-control select2 select2-hidden-accessible" name="Pass_Fail" style="width: 50%;"
                                                    tabindex="-1"
                                                    aria-hidden="true">
                                    <option>select</option>

                                    <option>Pass</option>
                                    <option>Fail</option>

                                </select>
                            </div>

                            <div class="form-group">

                              <b> Comments </b>


                               <input  class="form-control" name="Comments" type="text" style="width: 50%"/>

                               <!-- <textarea class="form-control" name="Comments" rows="3" style="width: 250px" placeholder="Enter Comments...."></textarea>
-->
                            </div>



                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                            <br>
                        </div>
                    </div>
                </div>


            </div>
        </div>







    </div>



@endsection
