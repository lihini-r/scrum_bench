@extends('app')

@section('content')

    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">

                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>User Roles</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">

                                <table class="table table-striped " id="myTable">
                                    <thead style="background-color: #3c8dbc">
                                    <tr style="font-weight: 900 ;color: #eff7ff">

                                        <td>ID</td>
                                        <td>Role Name</td>
                                        <td>Description</td>
                                        <td>Show</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $key => $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>


                                            <!-- we will also add show, edit, and delete buttons -->
                                            <td>

                                                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                <!-- we will add this later since its a little more complicated than the other two buttons -->

                                                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                <a class="btn btn-small btn-success" href="{{ URL::to('roles/' . $role->id) }}">Show Permissions</a>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table></div>
                        </div>
                    </div>
                </div> </div>
        </div>
    </div>

    </div>
@endsection
