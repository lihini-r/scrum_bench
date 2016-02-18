@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
@endsection
<?php
        $id= Auth::user()->name;
?>

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <br/>

                <br/>
                <p class="lead">Working Details.....<a href="{{ route('user_stories.index') }}"> <br>Back to Backlog</a></p>
                <br/>
                <div class="container">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>User Story ID</td>
                            <td>User ID</td>
                            <td>Description </td>

                            <td>Start Date</td>
                            <td>End Date</td>



                        </tr>
                        </thead>
                        <tbody>
                        @foreach($worklogs as $key => $worklog)
                            @if(strcmp($worklog->story_id,$_GET['story_id'])==0)
                            <tr>
                                <td>{{ $worklog->story_id }}</td>
                                <td>{{ $worklog->user_id }}</td>
                                <td>{{ $worklog->description }}</td>

                                <td>{{ $worklog->work_start_date }}</td>
                                <td>{{ $worklog->work_end_date }}</td>


                                <!-- we will also add show, edit, and delete buttons -->
                                <td>

                                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->


                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->


                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection