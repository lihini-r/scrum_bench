@extends('app')

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">
        <ul>
            <li> Name: {{ Auth::user()->name }}</li>
            <li> Email : {{ Auth::user()->email }}</li>
            <li> Designation: {{ Auth::user()->designation }}</li>
            <li> About: {{$profile->about }}</li>
            <li> Proffessional Qualifications : {{ $profile->prof_qual }}</li>
            <li> Academic Qualifications: {{$profile->acad_qual }}</li>
            <li> Prefered Technologies: {{ $profile->techno }}</li>






        </ul>
    </div>
@endsection