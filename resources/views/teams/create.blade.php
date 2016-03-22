
@extends('app')


@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">



        <a href="{{ route('teams.index') }}">Go back to all Teams</a></p>



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

                        <h1 style="color: #00a157">Add New Team</h1>

                    </div>

                </div>



                <div class="col-md-6" style="background-color:#7adddd">

            <br>

        {!! Form::open(['route' => 'teams.store']) !!}

                    <!--get team name-->

                 <div class="form-group">
                    {!! Form::label('TeamName', 'Team Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('TeamName', null, ['class' => 'form-control' , 'style' => 'width:50%;']) !!}
                 </div>


                    <!--assign developers to team-->

                 <div class="form-group">
                       <label>Select Developers</label>
                        <br>

                            <?php
                            use \App\User;


                            //get developers who are already assigned
                            $assdiv=DB::table('dev_team')->get();

                            foreach($assdiv as $ass)
                            {
                                //get developers in the system who are not assigned
                                $users = User::where('designation','Developer')->where('id','!=', $ass->user_id)->get();

                            }
                            ?>

                        @foreach ($users as $user)

                                    <!--get developers names as chechboxes but input value is user id-->


                     <input tabindex="1" type="checkbox" name="users[]" id="{{$user->id}}"
                                   value="{{$user->id}}"/> {{$user->name}} <br/>


                     @endforeach
                 </div>


            {!! Form::submit('Create Team', ['class' => 'btn btn-primary']) !!}



            {!! Form::close() !!}

            <br>
    </div>

    </div>
        </div>
    </div>


@endsection

