@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>

@section('content')

    <div class="container">
        <h1>New Message</h1>
        <br>
        <br>
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
            <div class="container">
        {!! Form::open(['route' => 'messages1s.store']) !!}

        <div class="form-group">
            {!! Form::label('to', 'To', ['class' => 'control-label']) !!}
            <input type='text' id='to' style="width: 150px" name='to'  >
            <input type='text' id='from' style="width: 0px" name='from' value={{ Auth::user()->name }}  >

        </div>

        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            <textarea  id="message" name="message" class="form-control" rows="6" cols="50" style='width: 570px'> </textarea>
        </div>


        {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
        </div>
    </div>
@endsection