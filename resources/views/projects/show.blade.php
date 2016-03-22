
@extends('app')

@section('content')
<br/>
<br/>
<br/>
<div class="container">
    <a href="{{ route('projects.index') }}">Go back to all Projects</a></p>




    <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
        <div class="box-header with-border">

            <div class="panel panel-info">

                <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                    <h1 style="color: #00a157">Project {{ $project->default.$project->ProjectID}}</h1>
                </div>

            </div>





            <div class="col-md-8" style="background-color: #7adddd">
                    <br>
                       <table class="table table-striped" style="background-color: #ddffdd">

                           <tbody>
                           <tr><td>Project Name</td>
                               <td>{{ $project->ProjectName }}</td></tr>

                           <tr><td>Description</td>
                               <td>{{ $project->Description }}</td></tr>

                           <tr><td> State</td>
                               <td>{{ $project->State }}</td></tr>

                           <tr><td> Duration</td>
                               <td>{{ $project->duration}} months</td></tr>




                           </tbody>
                       </table>



                </div>

</div>
        <br>
    </div>
    </div>
@endsection


