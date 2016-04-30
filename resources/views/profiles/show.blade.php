@extends('app')

@section('content')

    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>View My Profile</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">


                                <table><tr><td align="top">
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

                                        </td></tr>
                                    <tr><td>

                                        </td><td>  <div style="margin-left: 10%; ">
                                                <h4><b>About :</b></h4>
                                                <h4>{{$profile->about }}</h4>
                                                <h4><b>Proffessional Qualifications :</b></h4>
                                                <h4>{{ $profile->prof_qual }}</h4>
                                                <h4><b>Academic Qualifications :</b></h4>
                                                <h4>{{$profile->acad_qual }}</h4>

                                                @if(Auth::user()->designation==='Developer')
                                                    <h4><b>Prefered Technologies :</b></h4>
                                                    <h4>{{ $profile->techno }}</h4>

                                                @endif
                                            </div></td></tr></table>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection