@extends('app')

@section('page_styles')
<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
@endsection

@section('content')
<br/>
<div class="container">
<div class="box box-default">
<div class="box-header with-border">

<br/>
<div class="form-group" style="padding:20px 30px 20px 20px;">
	<a class="btn btn-small btn-info pull-right" href="{{ URL::to('sprints/create') }}">Create New Sprint</a>
</div>
<br/>
<br/>
<div class="scrollable_div">
    <table class="table table-striped table-bordered scrollable_div">
    <thead>
        <tr>
            <td>ID</td>
            <td>Sprint Name</td>
            <td>Project ID</td>
            <td>Start Date</td>
            <td>End Date</td>
			<td>Show/Edit</td>
        </tr>
    </thead>
    <tbody>
	@foreach($sprints as $key => $sprint)	
        <tr>
            <td>{{ $sprint->id }}</td>
            <td>{{ $sprint->sprint_name }}</td>
			<td>{{ $sprint->project_id }}</td>
            <td>{{ $sprint->start_date }}</td>
            <td>{{ $sprint->end_date }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('sprints/' . $sprint->id) }}">Show</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('sprints/' . $sprint->id . '/edit') }}">Edit</a>

            </td>
        </tr>
    @endforeach
	</tbody>
	</table>
</div>
</div>
</div>
</div>
@endsection