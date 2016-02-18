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
                <h1>Editing Account {{ $account->id }}</h1>
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
                    <?php $results = DB::table('users')->get(); ?>
                    <select class="form-control " name="acc_head" style="width: 50%"
                    >
                        <?php
                        foreach ($results as $result) {
                            $id = $result->id;
                            $name=$result->name;
                            $email = $result->email;
                            $pwd = $result->password;
                            $eid = $result->eid;
                            $designation = $result->designation;

                            if($designation=="Account Head"){

                                echo "<option value = $name >$name</option >";
                            }

                        }
                        ?>
                    </select>
                </div>




                {!! Form::submit('Update Account', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection









