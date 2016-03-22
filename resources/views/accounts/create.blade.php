
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
        <div class="container"> <div style="width:90%;padding:5px 5px 15px 80px;">
                <div class="panel panel-info" >
                    <div class="panel-heading"><h1>Create New Account</h1></div>

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

            {!! Form::open(['route' => 'accounts.store']) !!}

            <div class="form-group">
                {!! Form::label('acc_name', 'Account Name:', ['class' => 'control-label']) !!}
                {!! Form::text('acc_name', null, ['class' => 'form-control' , 'style' => 'width:50%;']) !!}
            </div>

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

                        echo "<option value = '$name' >$name</option >";
                        }

                    }
                    ?>
                </select>
                </div>





            {!! Form::submit('Create Account', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
                </div></div></div></div></div>
        </div>
    @endsection
