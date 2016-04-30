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
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <?php
                        foreach ($worklogs as $key => $worklog) {
                            if (strcmp($worklog->story_id, $_GET['story_id']) == 0) {
                                echo "<h3><b>" . $worklog->story_id . " Worklogs</b></h3>";
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>

                <p class="lead">
                    <small><a href="{{ URL::to('user_stories/'.$_GET['story_id']) }}">Back
                            to Story {{$_GET['story_id']}}</a></small>
                </p>

                <br>
                <table class="table table-striped table-bordered">
                    <thead style="background-color: #3c8dbc">
                    <tr style="font-weight: 900 ;color: #eff7ff">
                        <td>Description</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Duration (Hours)</td>
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
@endsection