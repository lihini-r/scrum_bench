
@extends('app')





@section('content')

    <br/>
    <div class="container" style="width: 100%" >
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">

            <div class="box-header with-border">
                <div style="width:100%;padding:5px 5px 15px 10px;">
                    <div class="panel panel-info" >
                        <div class="panel-heading"><h1>Account {{ $account->id }}</h1></div>

                        <div class="panel-body">

                            <div class="panel-body">


                                <ul>
                                    <li><b>Account Name: {{ $account->acc_name }}</b></li>
                                    <li><b>Description : {{ $account->description }}</b></li>
                                    <li><b>Account Head: {{ $account->acc_head }}</b></li>

                                </ul>



                                <table class="table table-striped " id="myTable">
                                    <thead style="background-color: #3c8dbc">
                                    <tr style="font-weight: 900 ;color: #eff7ff">
                                        <td >Project ID</td>
                                        <td >Project Name</td>
                                        <td >Description</td>

                                        <td>Duration</td>

                                        <td width="30%" >Progress</td>

                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    use Illuminate\Support\Facades\DB as DB;
                                    use App\Http\Controllers\AccountController;
                                    use App\Project;
                                    use App\Account;


                                    //$accounts = DB::table('accounts')->get();
                                    //foreach ($accounts as $account) {

                                    //}



                                    $result =DB::table('projects')->where('id',$account->id)->get();

                                    foreach($result as $key => $project){



                                        $progress=AccountController::showProjectProgress($project->ProjectID);

                                        echo "<tr>
                                        <td>$project->default$project->ProjectID </td>
                                        <td>$project->ProjectName</td>
                                        <td> $project->Description </td>

                                        <td> $project->duration </td>

                                       <td> $progress </td>



                                        </tr>";
                                    }



                                    ?>

                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection