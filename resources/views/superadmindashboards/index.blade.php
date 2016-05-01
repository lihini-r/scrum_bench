@extends('app')



@section('content')
    <br/>
    <div class="container"> <div style="width:90%;padding:5px 5px 15px 80px;">
            <div class="panel panel-info" style="width: 80%">
                <div class="panel-heading"><h1>Account  {{ $account->id }} </h1></div>

                <div class="panel-body" >

                    <div class="panel-body" style="margin-left: 1%">
                        <div class="panel" style="background: #76b4ff; ">
                            <ul>
                                <h4>Account Name : {{ $account->acc_name }}</h4>
                                <h4>Description  : {{ $account->description }}</h4>
                                <h4>Account Head : {{ $account->acc_head }}</h4>

                            </ul>

                        </div>



                        @if(\Auth::user()->hasRole('Super Admin'))
                            @foreach($projects as $key => $project)

                                <div class="col-lg-6 col-xs-10" >
                                    <div class="small-box " style="background: #2EFE9A ">
                                        <div class="inner">

                                            <h4>P{{ $project->ProjectID }}</h4>

                                            <p>{{ $project->ProjectName }}</p>


                                            <a class="btn btn-small " style="background: #045FB4; color: #f6f6f6"  href="{{ URL::to('superadmindashboards/' . $project->ProjectID . '/edit') }}" >
                                                More Info..
                                                <i class="fa fa-arrow-circle-right"></i>
                                            </a>

                                        </div></div></div>

                            @endforeach
                        @else
                            <img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">
                        @endif

                    </div></div></div></div></div>
    {{--<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">--}}
@endsection
