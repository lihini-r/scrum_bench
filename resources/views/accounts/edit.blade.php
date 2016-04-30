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
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Editing Account {{ $account->id }}</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

                                <p class="lead"> <a href="{{ route('accounts.index') }}">back</a></p>
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

                                {!! Form::model($account, [
                                'method' => 'PATCH',
                                'route' => ['accounts.update', $account->id]
                            ]) !!}

                                <div class="form-group">
                                    {!! Form::label('acc_name', 'Account Name:', ['class' => 'control-label']) !!}
                                    {!! Form::text('acc_name', null, ['class' => 'form-control','style' => 'width:50%;']) !!}
                                </div>

                                {{--<div class="form-group">
                                    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                                    {!! Form::text('description', null, ['class' => 'form-control', 'style' => 'width:50%;','readonly'=>'true']) !!}
                                </div>--}}

                                <div class="form-group">
                                    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                                    {!! Form::text('description', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                </div>


                                <div class="form-group">
                                    {!! Form::label('acc_head', 'Account Head:', ['class' => 'control-label']) !!}
                                    {!! Form::text('acc_head', null, ['class' => 'form-control', 'style' => 'width:50%;','readonly'=>'true']) !!}




                                </div>




                                {!! Form::submit('Update Account', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}

                            </div>
                        </div>  </div>  </div>  </div></div>  </div>
    </div>

@endsection









