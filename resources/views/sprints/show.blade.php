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
			<h1>Sprint {{ $sprint->id }}</h1>		
		</div>
		
		<div class="row">
            <div class="col-sm-6">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Sprint Name:</td>
                        <td>{{ $sprint->sprint_name }}</td>
                    </tr>
                    <tr>
                        <td>Project id:</td>
                        <td>{{ $sprint->project_id }}</td>
                    </tr>
                    <tr>
                        <td>Start Date:</td>
                        <td>{{ $sprint->start_date }}</td>
                    </tr>
                    <tr>
                        <td>End Date:</td>
                        <td>{{ $sprint->end_date }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-4">&nbsp;</div>
		</div>
	</div>
</div>
@endsection