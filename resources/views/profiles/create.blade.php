@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>
@section('content')
    <br/>
    <br/>
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

        {!! Form::open(['route' => 'profiles.store']) !!}

            <div class="form-group">
                {!! Form::label('id', 'User ID:', ['class' => 'control-label']) !!}
                {!! Form::text('id',  Auth::user()->id , ['class' => 'form-control' , 'style' => 'width:50%;','readonly'=>'true']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('about', 'About me:', ['class' => 'control-label']) !!}
                {!! Form::textarea('about', null, ['class' => 'form-control' , 'style' => 'width:50%;','size' => '20x3']) !!}
            </div>

        <div class="form-group">
            {!! Form::label('prof_qual', 'Professional Qualifications:', ['class' => 'control-label']) !!}
            {!! Form::textarea('prof_qual', null, ['class' => 'form-control', 'style' => 'width:50%;','size' => '20x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('acad_qual', 'Academic Qualifications:', ['class' => 'control-label']) !!}
            {!! Form::textarea('acad_qual', null, ['class' => 'form-control', 'style' => 'width:50%;','size' => '20x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('techno', 'Prefered Technologies:', ['class' => 'control-label']) !!}
            {!! Form::textarea('techno', null, ['class' => 'form-control', 'style' => 'width:50%;','size' => '20x3']) !!}
        </div>

        {!! Form::submit('Create Profile', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@endsection