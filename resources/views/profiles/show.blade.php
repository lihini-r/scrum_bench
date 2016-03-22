@extends('app')

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container"><div style="width:90%;padding:5px 5px 15px 80px;">
            <div class="panel panel-info" >
                <div class="panel-heading"><h1>View My Profile</h1></div>

                <div class="panel-body">

                    <div class="panel-body">

                        <table class="table table-striped table-bordered">
                            <thead style="background-color: #6495ED;">
                            <tr>
                                <td><b>Name</b></td>
                                <td><b>{{ Auth::user()->name }}</b></td>

                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td><b>{{ Auth::user()->email }}</b></td>

                            </tr>
                            <tr>
                                <td><b>Designation</b></td>
                                <td><b> {{ Auth::user()->designation }}</b></td>

                            </tr>
                            <tr>
                                <td><b>About</b></td>
                                <td> <b>{{$profile->about }}</b></td>

                            </tr>
                            <tr>
                                <td><b>Proffessional Qualifications</b> </td>
                                <td>  <b>{{ $profile->prof_qual }}</b></td>

                            </tr>
                            <tr>
                                <td><b> Academic Qualifications </b></td>
                                <td> <b>  {{$profile->acad_qual }}</b></td>

                            </tr>
                            <tr>
                                <td><b> Prefered Technologies </b></td>
                                <td> <b> {{ $profile->techno }}</b></td>

                            </tr>
                            </thead>

</table>
           {{--                 <ul>
            <li> Name: {{ Auth::user()->name }}</li>
            <li> Email : {{ Auth::user()->email }}</li>
            <li> Designation: {{ Auth::user()->designation }}</li>
            <li> About: {{$profile->about }}</li>
            <li> Proffessional Qualifications : {{ $profile->prof_qual }}</li>
            <li> Academic Qualifications: {{$profile->acad_qual }}</li>
            <li> Prefered Technologies: {{ $profile->techno }}</li>






        </ul>--}}
                    </div>  </div>  </div>  </div>  </div>
    </div>
@endsection