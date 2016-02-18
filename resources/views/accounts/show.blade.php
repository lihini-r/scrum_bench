
@extends('app')

@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">
        <h1>Account {{ $account->id }}</h1>
        <ul>
            <li>Account Name: {{ $account->acc_name }}</li>
            <li>Description : {{ $account->description }}</li>
            <li>Account Head: {{ $account->acc_head }}</li>

        </ul>
    </div>
@endsection