@extends('app')
<?php
use \App\Permission;
use Illuminate\Support\Facades\DB as DB;

?>


@section('content')
    <br/>


    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Grant Permissions</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">
                                <div class="container">

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#menu1">Administrator</a></li>

                                        <li><a data-toggle="tab" href="#menu2">Super Admin</a></li>
                                        <li><a data-toggle="tab" href="#menu3">Account Head</a></li>
                                        <li><a data-toggle="tab" href="#menu4">Project Manager</a></li>
                                        <li><a data-toggle="tab" href="#menu5">Developer</a></li>
                                    </ul>

                                    <div class="tab-content">

                                        <div id="menu1" class="tab-pane fade in active">
                                            {!! Form::model( 1, [
                                                            'method' => 'PATCH',
                                                            'route' => ['permissions.update',1]
                                                        ]) !!}
                                            <br/> <br/>
                                            <?php


                                            $perms = DB::table('permission_role')->where('role_id',1)->get();


                                            $perm_ids = array();
                                            foreach ($perms as $perm) {
                                                array_push($perm_ids, $perm->permission_id);
                                            }

                                            $permissions = DB::table('permissions')->select('display_name','id')->get();
                                            $perms_assigned=array();
                                            foreach ($permissions as $perm) {
                                                if (in_array($perm->id, $perm_ids)) {
                                                    $perms_assigned[$perm->id] = "checked";
                                                } else {
                                                    $perms_assigned[$perm->id] = "";
                                                }
                                            }
                                            ?>

                                            @foreach ($permissions as $perm)
                                                <input tabindex="1" type="checkbox" name="permissions[]" id="{{$perm->id}}"
                                                       value="{{$perm->id}}" <?php echo strcmp($perms_assigned[$perm->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$perm->display_name}}
                                                <br/>
                                            @endforeach

                                            <br>
                                            <br>

                                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                                            {!! Form::close() !!}
                                            <br>





                                        </div>
                                        <div id="menu2" class="tab-pane fade">
                                            {!! Form::model( 2, [
                                                           'method' => 'PATCH',
                                                           'route' => ['permissions.update',2]
                                                       ]) !!}
                                            <br/> <br/>
                                            <?php


                                            $perms = DB::table('permission_role')->where('role_id',2)->get();


                                            $perm_ids = array();
                                            foreach ($perms as $perm) {
                                                array_push($perm_ids, $perm->permission_id);
                                            }

                                            $permissions = DB::table('permissions')->select('display_name','id')->get();
                                            $perms_assigned=array();
                                            foreach ($permissions as $perm) {
                                                if (in_array($perm->id, $perm_ids)) {
                                                    $perms_assigned[$perm->id] = "checked";
                                                } else {
                                                    $perms_assigned[$perm->id] = "";
                                                }
                                            }
                                            ?>

                                            @foreach ($permissions as $perm)
                                                <input tabindex="1" type="checkbox" name="permissions[]" id="{{$perm->id}}"
                                                       value="{{$perm->id}}" <?php echo strcmp($perms_assigned[$perm->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$perm->display_name}}
                                                <br/>
                                            @endforeach

                                            <br>
                                            <br>

                                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                                            {!! Form::close() !!}
                                            <br>





                                        </div>
                                        <div id="menu3" class="tab-pane fade">
                                            {!! Form::model( 3, [
                                                           'method' => 'PATCH',
                                                           'route' => ['permissions.update',3]
                                                       ]) !!}
                                            <br/> <br/>
                                            <?php


                                            $perms = DB::table('permission_role')->where('role_id',3)->get();


                                            $perm_ids = array();
                                            foreach ($perms as $perm) {
                                                array_push($perm_ids, $perm->permission_id);
                                            }

                                            $permissions = DB::table('permissions')->select('display_name','id')->get();
                                            $perms_assigned=array();
                                            foreach ($permissions as $perm) {
                                                if (in_array($perm->id, $perm_ids)) {
                                                    $perms_assigned[$perm->id] = "checked";
                                                } else {
                                                    $perms_assigned[$perm->id] = "";
                                                }
                                            }
                                            ?>

                                            @foreach ($permissions as $perm)
                                                <input tabindex="1" type="checkbox" name="permissions[]" id="{{$perm->id}}"
                                                       value="{{$perm->id}}" <?php echo strcmp($perms_assigned[$perm->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$perm->display_name}}
                                                <br/>
                                            @endforeach

                                            <br>
                                            <br>

                                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                                            {!! Form::close() !!}
                                            <br>





                                        </div>
                                        <div id="menu4" class="tab-pane fade">
                                            {!! Form::model( 4, [
                                                           'method' => 'PATCH',
                                                           'route' => ['permissions.update',4]
                                                       ]) !!}
                                            <br/> <br/>
                                            <?php


                                            $perms = DB::table('permission_role')->where('role_id',4)->get();


                                            $perm_ids = array();
                                            foreach ($perms as $perm) {
                                                array_push($perm_ids, $perm->permission_id);
                                            }

                                            $permissions = DB::table('permissions')->select('display_name','id')->get();
                                            $perms_assigned=array();
                                            foreach ($permissions as $perm) {
                                                if (in_array($perm->id, $perm_ids)) {
                                                    $perms_assigned[$perm->id] = "checked";
                                                } else {
                                                    $perms_assigned[$perm->id] = "";
                                                }
                                            }
                                            ?>

                                            @foreach ($permissions as $perm)
                                                <input tabindex="1" type="checkbox" name="permissions[]" id="{{$perm->id}}"
                                                       value="{{$perm->id}}" <?php echo strcmp($perms_assigned[$perm->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$perm->display_name}}
                                                <br/>
                                            @endforeach

                                            <br>
                                            <br>

                                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                                            {!! Form::close() !!}
                                            <br>





                                        </div>
                                        <div id="menu5" class="tab-pane fade">
                                            {!! Form::model( 5, [
                                                           'method' => 'PATCH',
                                                           'route' => ['permissions.update',5]
                                                       ]) !!}
                                            <br/> <br/>
                                            <?php


                                            $perms = DB::table('permission_role')->where('role_id',5)->get();


                                            $perm_ids = array();
                                            foreach ($perms as $perm) {
                                                array_push($perm_ids, $perm->permission_id);
                                            }

                                            $permissions = DB::table('permissions')->select('display_name','id')->get();
                                            $perms_assigned=array();
                                            foreach ($permissions as $perm) {
                                                if (in_array($perm->id, $perm_ids)) {
                                                    $perms_assigned[$perm->id] = "checked";
                                                } else {
                                                    $perms_assigned[$perm->id] = "";
                                                }
                                            }
                                            ?>

                                            @foreach ($permissions as $perm)
                                                <input tabindex="1" type="checkbox" name="permissions[]" id="{{$perm->id}}"
                                                       value="{{$perm->id}}" <?php echo strcmp($perms_assigned[$perm->id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$perm->display_name}}
                                                <br/>
                                            @endforeach

                                            <br>
                                            <br>

                                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                                            {!! Form::close() !!}
                                            <br>





                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> </div>

    </div>
@endsection
