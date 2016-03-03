@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
@endsection
<?php
    $id = Auth::user()->name;
?>

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Working Details.....</b></h3>
                    </div>
                </div>
                <br/>
                <p class="lead"><br/><a href="{{ URL::to('user_stories/'.$_GET['story_id']) }}">Back
                        to Story {{$_GET['story_id']}}</a></p>
                <br/>
                <div class="container">
                    <?php
                    foreach ($worklogs as $key => $worklog) {
                        if (strcmp($worklog->story_id, $_GET['story_id']) == 0) {
                            echo "<h3>" . $worklog->story_id . " Worklogs</h3><br/>";
                            break;
                        }
                    }
                    ?>
                    <table class="table table-striped table-bordered">
                        <thead style="background-color: #cdc1c5">
                        <tr>
                            <td>Description</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Duration</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($worklogs as $key => $worklog)
                            @if(strcmp($worklog->story_id,$_GET['story_id'])==0)
                                <tr>
                                    <td>{{ $worklog->description }}</td>
                                    <td>{{ $worklog->work_start_date }}</td>
                                    <td>{{ $worklog->work_end_date }}</td>
                                    <td>{{ $worklog->duration }}</td>
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