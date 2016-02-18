@extends('app')

@section('content')
<br/>
<div class="form-group" style="padding:20px 30px 20px 20px;">
	<a class="btn btn-small btn-info pull-right" href="{{ URL::to('accounts/create') }}">Create New Account</a>
</div>
<br/>
<br/>
<div class="container">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Account Name</td>
            <td>Description</td>
            <td>Account Head</td>

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
                <a class="btn btn-small btn-success" href="{{ URL::to('accounts/' . $account->id) }}">Show this Account</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('accounts/' . $account->id . '/edit') }}">Edit this Account</a>

            </td>
        </tr>
    @endforeach
	</tbody>
	</table>
</div>
@endsection