@extends('app')
<?php
use Illuminate\Support\Facades\DB as DB;
use \App\Http\Controllers\AccountController;

$accounts = DB::table('accounts')->get();


?>

@section('content')
	<br/>
	<div class="container"> <div style="width:90%;padding:5px 5px 15px 80px;">
			<div class="panel panel-info" style="width: 80%">
				<div class="panel-heading"><h1> Dashboard</h1></div>

				<div class="panel-body">

					<div class="panel-body" style="margin-left: 1%">


						@if(\Auth::user()->hasRole('Super Admin'))
							@foreach($accounts as $key => $account)
								@if($account->Hide==="off")
									<div class="col-lg-6 col-xs-10" >
										<div class="small-box bg-aqua">
											<div class="inner">

												<h4>{{ $account->acc_name }}</h4>

												<p>Account Head : {{ $account->acc_head }}</p>

												<a class="btn btn-small btn-success"  href="{{ URL::to('superadmindashboards/' . $account->id) }}" >
													More Info..
													<i class="fa fa-arrow-circle-right"></i>
												</a>

											</div></div></div>
								@endif
							@endforeach
						@else
							<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">
						@endif

					</div></div></div></div></div>
	{{--<img src="{{ URL::asset('dist/img/project-team1.png') }}" alt="Team Image">--}}
@endsection
