@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>
@section('content')
    <br/>

    <div class="container">
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

        {!! Form::open(['route' => 'user_stories.store']) !!}

        <div class="form-group">
            {!! Form::label('project_id', 'Project Name:', ['class' => 'control-label']) !!}
            {!! Form::text('project_id', null, ['class' => 'form-control' , 'style' => 'width:50%;']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('summary', 'Summary :', ['class' => 'control-label']) !!}
            {!! Form::text('summary', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('priority', 'Priority:', ['class' => 'control-label']) !!}
            {!! Form::text('priority', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
        </div>

            <div class="form-group">
                {!! Form::label('due_date', 'Due Date:', ['class' => 'control-label']) !!}
                {!! Form::text('due_date', null, ['class' => 'form-control' , 'style' => 'width:50%;']) !!}
            </div>
        <div class="form-group">
            {!! Form::label('assignee', 'Assignee:', ['class' => 'control-label']) !!}
            {!! Form::text('assignee', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
        </div>

            <div class="form-group">
                {!! Form::label('reporter', 'Reporter:', ['class' => 'control-label']) !!}
                {!! Form::text('reporter', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('org_est', 'Orginal estimate:', ['class' => 'control-label']) !!}
                {!! Form::text('org_est', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
            </div>

        {!! Form::submit('Create User Story', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@endsection