@extends('app')

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">


        <div align="left"><table><tr><td>
            <div><img src="{{ URL::asset('dist/img/pm.png')}}" class="user-image" alt="User Image" height="150" width="150">


        </div>
                    </td><td>
            <div style="margin-left: 10%; ">
                <h3><b>{{Auth::user()->name}}</b></h3>
                <h4> <b>E-mail :</b></h4>
                <h4>{{Auth::user()->email}}</h4>
                <h4><b>Designation :</b></h4><h4>{{Auth::user()->designation}}</h4>

            </div> </td></tr></table>

        </div>


        <?php

            use App\Profile;

        $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

        @if ($profile === null)
            <div class="form-group" style="padding:20px 30px 20px 20px;">
            <a class="btn btn-small btn-info pull-left" href="{{ URL::to('profiles/create') }}">Create My Profile</a>
        </div>

       @endif




      @if ($profile !== null)

        <div class="form-group" style="padding:20px 30px 20px 20px;">
            <a class="btn btn-small btn-info pull-left" href="{{ URL::to('profiles/' . Auth::user()->id . '/edit') }}">Edit My Profile</a>
        </div>
        <div class="form-group" style="padding:20px 30px 20px 20px;">
        <a class="btn btn-small btn-success" href="{{ URL::to('profiles/' . Auth::user()->id) }}">View My Profile</a>

        </div>
          @endif
    </div>
@endsection