
@extends('app')

@section('content')
<br/>
<br/>
<br/>
<div class="container">
    <a href="{{ route('projects.index') }}">Go back to all Projects</a></p>


    <h1 style="color: #00a157">Project {{ $project->default.$project->ProjectID}}</h1>

    <div class="col-md-8" style="background-color: #99ee99">
        <br>
   <table class="table table-striped" style="background-color: #ddffdd">

       <tbody>
       <tr><td>Project Name</td>
           <td>{{ $project->ProjectName }}</td></tr>

       <tr><td>Description</td>
           <td>{{ $project->Description }}</td></tr>

       <tr><td> State</td>
           <td>{{ $project->State }}</td></tr>

       <tr><td> Added Date</td>
           <td>{{ $project->add_date }}</td></tr>


       <tr><td> Due Date</td>
           <td>{{ $project->due_date }}</td></tr>



       </tbody>
   </table>



    </div>

</div>
@endsection


