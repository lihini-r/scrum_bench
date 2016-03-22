
@extends('app')





@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container"> <div style="width:90%;padding:5px 5px 15px 80px;">
            <div class="panel panel-info" >
                <div class="panel-heading"><h1>Account {{ $account->id }}</h1></div>

                <div class="panel-body">

                    <div class="panel-body">


        <ul>
            <li><b>Account Name: {{ $account->acc_name }}</b></li>
            <li><b>Description : {{ $account->description }}</b></li>
            <li><b>Account Head: {{ $account->acc_head }}</b></li>

        </ul>



        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Project ID</td>
                <td>Project Name</td>
                <td>Description</td>
                <td>State</td>
                <td>Duration</td>

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

                    echo "<tr>
                        <td>$project->default$project->ProjectID </td>
                        <td>$project->ProjectName</td>
                        <td> $project->Description </td>
                        <td> $project->State </td>
                        <td> $project->duration </td>





                    </tr>";
                }



                ?>

                </tbody>


        </table>

                    </div>           </div>  </div>  </div>  </div>
    </div>
@endsection