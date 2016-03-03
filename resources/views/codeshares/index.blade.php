@extends('app')

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px; position: absolute;top: 170px;right: 150px">

        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('codeshares/create') }}">Post new code</a>
    </div>

    <div class="container">
        <h1>Code List</h1>
        <br>
            @foreach($codeshares as $key => $codeshare)
            <div class="container" >
                <h4><b><a  href="{{ URL::to('codeshares/' . $codeshare->codeId) }}">{{ $codeshare->title }}</a></b></h4>
                <br> <span style='background-color: #5bc0de'>
                    {{ $codeshare->language }}</span></b><br><br><p>
                    {{ $codeshare->description }}</p><br/><hr>

                <!-- we will also add show, edit, and delete buttons -->
            </div>
        @endforeach



    </div>
@endsection