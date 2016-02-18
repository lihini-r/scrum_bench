@extends('app')

@section('content')
<br/>
<div style="width:80%;padding:5px 5px 15px 80px;">
<div class="panel panel-success" >
	<div class="panel-heading">Home</div>

	<div class="panel-body">
		You are logged in!
	</div>
</div>
</div>
<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">
@endsection
