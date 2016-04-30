@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>
@section('content')

    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">

                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Create My Profile</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

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
                                @if(Auth::user()->designation==='Developer')
                                    <div class="form-group">
                                        {!! Form::label('techno', 'Prefered Technologies:', ['class' => 'control-label']) !!}
                                        {!! Form::textarea('techno', null, ['class' => 'form-control', 'style' => 'width:50%;','size' => '20x3']) !!}
                                    </div>
                                @endif
                                {!! Form::submit('Create Profile', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}
                            </div></div></div></div></div></div></div>
    </div>
@endsection