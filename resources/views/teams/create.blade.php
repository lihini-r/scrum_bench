
@extends('app')



@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('../../../public/plugins/multiple-Select/multiple-select.css') }}">

    <script type="text/javascript" src="{{ URL::asset('../../../public/plugins/multiple-Select/multiple-select.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('../../../public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>


    <link rel="stylesheet" href="{{ URL::asset('../../../public/plugins/multiple-Select/assets/bootstrap/css/bootstrap.css') }}">


@endsection




@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">


        <h1 style="color: #00a157">Add New Team</h1>

        <a href="{{ route('teams.index') }}">Go back to all Teams</a></p>



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


        <div class="col-md-6" style="background-color: #99ee99">

            <br>

        {!! Form::open(['route' => 'teams.store']) !!}

        <div class="form-group">
            {!! Form::label('TeamName', 'Team Name:', ['class' => 'control-label']) !!}
            {!! Form::text('TeamName', null, ['class' => 'form-control' , 'style' => 'width:50%;']) !!}
        </div>

     <div class="form-group">

            <label>Select Developers</label>
            <br>

                <?php
                use \App\User;
                $users = User::where('designation','Developer')->get();
                ?>

            @foreach ($users as $user)
                <input tabindex="1" type="checkbox" name="users[]" id="{{$user->id}}"
                       value="{{$user->id}}"/> {{$user->name}} <br/>
            @endforeach


</div>


        {!! Form::submit('Create Team', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}

            <br>
    </div>

    </div>



@endsection

