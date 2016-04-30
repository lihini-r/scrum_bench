@extends('app')

@section('content')
    <br/>


    @if(Session::has('flash_message'))
        <div class="alert alert-danger">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>My Profile</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">



                                <div align="left"><table><tr><td>
                                                <?php

                                                use App\Profile;

                                                $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

                                                @if ($profile === null)
                                                    <div><img src="{{ URL::asset('dist/img/pm.png')}}" class="user-image" alt="User Image" height="150" width="150">


                                                    </div>  @endif
                                                @if ($profile !== null)
                                                    <div><img src="{{ URL::asset('dist/img/'.$profile->profile_pic)}}" class="user-image" alt="User Image" height="150" width="150">


                                                    </div>
                                                @endif



                                            </td><td>
                                                <div style="margin-left: 10%; ">
                                                    <h3><b>{{Auth::user()->name}}</b></h3>
                                                    <h4> <b>E-mail :</b></h4>
                                                    <h4>{{Auth::user()->email}}</h4>
                                                    <h4><b>Designation :</b></h4><h4>{{Auth::user()->designation}}</h4>

                                                </div> </td>
                                            <td>

                                            </td></tr></table>

                                </div>


                                <?php



                                $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

                                @if ($profile === null)
                                    <div class="form-group" style="padding:20px 30px 20px 20px;">
                                        <a class="btn btn-small btn-info pull-left" href="{{ URL::to('profiles/create') }}">Create My Profile</a>
                                    </div>

                                @endif




                                @if ($profile !== null)
                                    <div class="container" style="width:40%;padding:5px 5px 15px 80px;background: #A9D0F5" align="left">

                                        {!! Form::model($profile, [ 'method' => 'POST',
                                                                    'route' => ['profiles.upload', $profile->id],
                                                                    'files'=>true]) !!}

                                        <div class="form-group">
                                            {!! Form::hidden('id',  Auth::user()->id ) !!}
                                        </div>

                                        <div class="form-group">
                                            <h4><b>Upload Profile Picture</b></h4>
                                            {!! Form::file('profile_pic') !!}
                                        </div>

                                        {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}

                                        {!! Form::close() !!}
                                    </div>

                                    <div class="form-group" style="padding:20px 30px 20px 20px;">
                                        <a class="btn btn-small btn-info pull-left" href="{{ URL::to('profiles/' . Auth::user()->id . '/edit') }}">Edit My Profile</a>
                                    </div>
                                    <div class="form-group" style="padding:20px 30px 20px 20px;">
                                        <a class="btn btn-small btn-success" href="{{ URL::to('profiles/' . Auth::user()->id) }}">View My Profile</a>

                                    </div>
                                @endif
                            </div></div></div></div></div>
        </div></div></div>
@endsection