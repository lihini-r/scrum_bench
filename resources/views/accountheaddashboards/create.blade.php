@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>
@section('content')

    <div class="container">
        <h1>Dashboard</h1>
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

        {!! Form::open(['route' => 'accountheaddashboards.store']) !!}

        <div class="form-group" style="position: absolute;top: 200px;left: 320px">

            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/folder.ico') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 1', ['class' => 'control-label']) !!}
        </div>

        <div class="form-group" style="position: absolute;top: 200px;left: 620px">
            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/Folder-Green.ico') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 2', ['class' => 'control-label']) !!}
        </div>

        <div class="form-group" style="position: absolute;top: 200px;left: 920px">
            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/Folder-Pink.ico') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 3', ['class' => 'control-label']) !!}
        </div>
        <div class="form-group" style="position: absolute;top: 200px;left: 1220px">
            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/Places-folder-blue-icon.png') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 4', ['class' => 'control-label']) !!}
        </div>

        <div class="form-group" style="position: absolute;top: 400px;left: 320px">
            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/open_folder.ico') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 5', ['class' => 'control-label']) !!}
        </div>

        <div class="form-group" style="position: absolute;top: 400px;left: 620px">
            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/Oxygen-Icons.org-Oxygen-Places-folder-red.ico') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 6', ['class' => 'control-label']) !!}
        </div>
        <div class="form-group" style="position: absolute;top: 400px;left: 920px">
            <a href="{{ url('messages1s/create') }}"><span><img src="{{ URL::asset('dist/img/folder.png') }}"  width="100" height="120"></span> </a>
            <br>
            {!! Form::label('project', 'project 6', ['class' => 'control-label']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection