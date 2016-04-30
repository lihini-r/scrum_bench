@extends('app')






.







<?php
//use Illuminate\Support\Facades\DB as DB;
use \App\Http\Controllers\AccountController;

$accounts = DB::table('accounts')->get();


?>





@section('content')



	<br/>
	<div style="width:90%;padding:5px 5px 15px 80px;">
		<div class="panel panel-success" >




			   @if(\Auth::user()->hasRole('Super Admin'))

			<div class="panel-heading">Super Admin Dashboard</div>

			<div class="panel-body">

				<div class="panel-body">

					<table class="table table-striped table-hover">
						<thead style="background-color: #34cccd; color: white; font-size: 120%;">
						<tr>
							<td>Account ID</td>
							<td>Account Name</td>
							<td>Description</td>
							<td>Account Head</td>
							<td>Show</td>
						</tr>
						</thead>
						<tbody>
						@foreach($accounts as $key => $account)
							<tr>
								<td>{{ $account->id }}</td>
								<td>{{ $account->acc_name }}</td>
								<td>{{ $account->description }}</td>
								<td>{{ $account->acc_head }}</td>


								<!-- we will also add show, edit, and delete buttons -->
								<td>

									<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
									<!-- we will add this later since its a little more complicated than the other two buttons -->

									<!-- show the nerd (uses the show method found at GET /nerds/{id} -->

									<a class="btn btn-small btn-success" href="{{ URL::to('accounts/' . $account->id) }}">Show </a>

									<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->


								</td>
							</tr>
						@endforeach
						</tbody>
					</table>

				</div>
			</div>

		</div>
		@else
			<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">
			@endif
	</div>
	</div>
	{{--<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">--}}








			.


@endsection
