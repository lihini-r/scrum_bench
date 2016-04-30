@extends('app')

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px; position: absolute;top: 170px;right: 150px">
        <!--directs to create to post codes-->
        <a class="btn btn-small btn-success pull-right" href="{{ URL::to('codeshares/create') }}">Post new code</a>
    </div>

    <div class="container">
        <div class="container">
            <h1>Code Board</h1>
            <br>
            @foreach($codeshares as $key => $codeshare)
                    <!--display all codes posted -->
            <div class="container" >
                <h4><b><a  href="{{ URL::to('codeshares/' . $codeshare->codeId) }}">{{ $codeshare->title }}</a></b></h4>
                <br>
                <span style='background-color: #5bc0de'><b>{{ $codeshare->language }}</b></span>
                <br>
                <br>
                <pre style='width: 80%'>{{ $codeshare->description }}</pre>
                <br>
                <hr>
            </div>
            @endforeach
        </div>
    </div>

@endsection