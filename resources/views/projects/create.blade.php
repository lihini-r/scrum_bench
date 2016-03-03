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

        <h1 style="color: #00a157">Add New Project</h1>

        <a href="{{ route('projects.index') }}">Go back to all Projects</a></p>

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


        <div class="col-md-7" style="background-color:  #99ee99">
            <br>


            {!! Form::open(['route' => 'projects.store'])!!}

        <div class="form-group">

            <div class="form-group" >
                @foreach($account as $key => $acc)


                <b>Account Name</b><input  readonly class="form-control" name="acc_name" type="text" value="{{$acc->acc_name}}" placeholder="Enter Project Name"
                                   style="width: 50%;" type="number"/>

                @endforeach
            </div>

        </div>




        <div class="form-group">

                    <div class="form-group">
                       <b> Project Name</b><input class="form-control" name="ProjectName" type="text" placeholder="Enter Project Name"
                                           style="width: 50%;" type="number"/>
                    </div>

                </div>


                <div class="form-group">
                    <b> Description</b><textarea class="form-control" placeholder="Enter ..." rows="3" name="Description" style="width: 50%;"
                                         tabindex="2"></textarea>
                </div>

                <div class="form-group">
                    <b>State</b><select class="form-control select2 select2-hidden-accessible" name="State" style="width: 50%;"
                                 tabindex="-1"
                                 aria-hidden="true">
                        <option>Open</option>
                        <option>Closed</option>
                        <option>Released</option>
                    </select>
                </div>


                <div class="form-group">
                    <b>Added Date</b>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </div>
                        <input class="form-control" type="text" data-mask="" name="add_date"
                               data-inputmask="'alias': 'yyyy-mm-dd'"
                               style="width: 48.5%;"/>
                    </div>
                </div>




                <div class="form-group">
                    <b>Due Date</b>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </div>
                        <input class="form-control" type="text" data-mask="" name="due_date"
                               data-inputmask="'alias': 'yyyy-mm-dd'"
                               style="width: 48.5%;"/>
                    </div>
                </div>


            {!! Form::submit('Add Project', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}




        </div>


    </div>
<br>

    </div>






    <script>


        $(function () {
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
            //Money Euro
            $("[data-mask]").inputmask();
        });




    </script>



@endsection