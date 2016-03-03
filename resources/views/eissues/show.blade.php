@extends('app')

@section('content')
    <div class="container">
        <h1>Email {{ $eissue->eID }}</h1>
        <ul>
            <li>Sprint Name: {{ $eissue->emailFrom }}</li>
            <li>Project id: {{ $codeshare->subject }}</li>
            <li>Start Date: {{ $codeshare->message }}</li>
            <li>End Date: {{ $codeshare->attach }}</li>
        </ul>
    </div>
@endsection