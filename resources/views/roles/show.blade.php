
@extends('app')





@section('content')

    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Role : {{ $role->name }}</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">







                                <table class="table table-striped " id="myTable">
                                    <thead style="background-color: #3c8dbc">
                                    <tr style="font-weight: 900 ;color: #eff7ff">

                                        <td>ID</td>
                                        <td>Permission</td>
                                        <td>Description</td>


                                    </tr>
                                    </thead>


                                    <tbody>

                                    @foreach($perms as $key => $perm)
                                        <tr>
                                            <td>{{ $perm->id }}</td>
                                            <td>{{ $perm->name }}</td>
                                            <td>{{ $perm->description }}</td>


                                            <!-- we will also add show, edit, and delete buttons -->
                                            {{-- <td>



                                                     <a class="btn btn-small btn-info" href="{{ URL::action('RoleController@permission', [$role->id,$perm->id] ) }}">Attach</a>


                                             </td>--}}
                                        </tr>

                                    @endforeach
                                    </tbody>





                                </table>
                            </div>  </div>  </div>  </div>  </div></div>  </div>

    </div>
@endsection