@extends('app')

@section('page_styles')
<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
<style>
.text-width {
  width: 50%;
}
</style>
@endsection

@section('content')
<br/>
<div class="container">
<div class="box box-default">
<div class="box-header with-border">
<br/>
    <h1>Editing Sprint {{ $sprint->id }}</h1>
    <p class="lead">Edit and save this Sprint below, or <a href="{{ route('sprints.index') }}">Go back to all Sprints</a></p>
    <hr>
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

            {!! Form::model($sprint, [
            'method' => 'PATCH',
            'route' => ['sprints.update', $sprint->id]
        ]) !!}

            <div class="form-group">
                {!! Form::label('sprint_name', 'Sprint Name:', ['class' => 'control-label']) !!}
                {!! Form::text('sprint_name', null, ['class' => 'form-control','style' => 'width:50%;']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('project_id', 'Project ID:', ['class' => 'control-label']) !!}
                {!! Form::text('project_id', null, ['class' => 'form-control', 'style' => 'width:50%;','readonly'=>'true']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('start_date', 'Start Date:', ['class' => 'control-label']) !!}
                {!! Form::text('start_date', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('end_date', 'End Date:', ['class' => 'control-label']) !!}
                {!! Form::text('end_date', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
            </div>

    {!! Form::submit('Update Sprint', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

</div>
</div>
</div>
@endsection