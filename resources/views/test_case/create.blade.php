@extends('app')

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">


        <a href="{{ route('test_case.index') }}">Go back to all Test Cases</a></p>

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

                        <h1 style="color: #00a157">Create Test Case</h1>

                    </div>

                </div>

<div class="col-md-12">





                <div class="col-md-7" style="background-color:  #7adddd">
                    <br>


                    {!! Form::open(['route' => 'test_case.store'])!!}



                    <div class="form-group">

                        <div class="form-group" >
                                <b>TestCase Name</b><input  class="form-control" name="TestCaseName" type="text" style="width: 80%"/>

                        </div>

                    </div>


                    <div class="form-group">

                        <div class="form-group">
                            <b> Scenario</b>


                            <input class="form-control" name="Scenario" type="text"
                                   style="width: 80%; height: 100px" type="number"/>


                          <!--  <textarea class="form-control" placeholder="Enter ..." rows="3" name="Scenario" style="width: 50%;"
                                                        tabindex="2"></textarea>-->
                        </div>

                    </div>


                    <div class="form-group">
                        <b> Test Steps</b>

                        <input class="form-control" name="TestSteps" type="text"
                               style="width: 80%; height: 100px" type="number"/>


                       <!-- <textarea class="form-control" placeholder="Enter ..." rows="3" name="TestSteps" style="width: 50%;"
                                                     tabindex="2"></textarea>-->
                    </div>

                    <div class="form-group">

                        <div class="form-group">
                            <b>Expected Outcome </b><input class="form-control" name="ExpectedOutcome" type="text"
                                                   style="width: 80%;" type="number"/>
                        </div>

                    </div>


                    <div class="form-group">

                        <div class="form-group">

                       <b>   User Story  </b><select class="form-control" name="user_story" style="width: 80%">
                            @foreach($user_story as $us)



                                <option value ={{$us->summary}}>{{$us->summary}}</option>


                                @endforeach
                            </select>

                        </div>

                    </div>



                    <div class="form-group">

                        <div class="form-group" >
                            <input  readonly class="form-control" name="uid" type="hidden" value="{{\Auth::user()->id}}"
                                           style="width: 50%;" type="number"/>


                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-group">
                          <input class="form-control" name="ActualOutcome" type="hidden" value="not yet tested"
                                                           style="width: 50%;" />
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-group">
                            <input class="form-control" name="Pass_Fail" type="hidden" value="not yet tested"
                                   style="width: 50%;" />
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-group">
                            <input class="form-control" name="Comments" type="hidden" value="not yet tested"
                                   style="width: 50%;" />
                        </div>

                    </div>


                    {!! Form::submit('Create Test Case', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}


                    <br>

                </div>








<!--display userstories assigned to logged developer-->

    <div class="col-md-4">

        <h1 style="color: #0000C2">My User Stories</h1>
        @foreach($user_story as $us)

        <div class="info-box bg-green-gradient">
            <span class="info-box-icon ">
              <i class='glyphicon glyphicon-bookmark'> </i>
            </span>
             <div class="info-box-content">
                    <span class="info-box-text">{{$us->story_id}}</span>
                    <span class="info-box-number">{{$us->summary}}</span>


                 <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                          <span class="progress-description">
                           Estimated to {{$us->org_est}} Hours
                          </span>



              </div>


        </div>
@endforeach





    </div>






</div>
            <br>

        </div>
    </div>
    <br>

    </div>
@endsection