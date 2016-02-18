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

        <ul class="nav nav-pills">
            <!--<li role="presentation"><a href="#">Edit</a>
            </li>
            <li role="presentation"><a href="#" data-toggle="modal" data-target="#assign-me">Assign To Me</a></li>
            <li role="presentation"><a href="#" data-toggle="modal" data-target="#work-log">WorkLog</a></li>-->
            <li><p class="lead">Backlog</p></li>
            <div class="form-group" style="padding:20px 30px 20px 20px;">
                <a class="btn btn-small btn-info pull-right" href="{{ URL::to('user_stories/create') }}">Create New User Story</a>
            </div>
        </ul>

    <br/>
    <br/>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>story ID</td>
                <td>project Name</td>
                <td>Summary </td>

                <td>Due Date</td>
                <td>Assignee</td>


                <td>Show/Edit</td>
            </tr>
            </thead>
            <tbody>
            @foreach($user_stories as $key => $user_story)
                <tr>
                    <td>{{ $user_story->story_id }}</td>
                    <td>{{ $user_story->project_id }}</td>
                    <td>{{ $user_story->summary }}</td>

                    <td>{{ $user_story->due_date }}</td>
                    <td>{{ $user_story->assignee }}</td>


                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('user_stories/' . $user_story->story_id) }}">Show</a>

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('user_stories/' . $user_story->story_id . '/edit') }}">Edit</a>

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