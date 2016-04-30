@extends('app')

@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>{{ $task->story_id  }}</b></h3>
                    </div>
                </div>
                <p class="lead">
                    <small>View Task Details below <a href="{{ route('tasks.index') }}">Back to All Tasks</a>
                    </small>
                </p>

                <br>
                <br>

                <div class="row">
                    <div class="col-sm-4">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Project ID:    </td>
                                <td>{{$task->project_id }}</td>
                            </tr>
                            <tr>
                                <td>Summary:    </td>
                                <td>{{$task->summary }}</td>
                            </tr>
                            <tr>
                                <td>Description:    </td>
                                <td>{{ $task->description }}</td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>{{ $task->priority }}</td>
                            </tr>
                            <tr>
                                <td>Due Date:</td>
                                <td>{{ $task->due_date }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-4">&nbsp;</div>
                </div>

                @if($errors->any())
                    <script>
                        $(function () {
                            $('#result-model-title').html('Error');
                            $('#result-modal').modal('show');
                        });
                    </script>
                @endif
                @if(Session::has('flash_message'))
                    <script>
                        $(function () {
                            $('#result-model-title').html('Message');
                            $('#result-modal').modal('show');
                        });
                    </script>
                    @endif


                            <!--Result Modal -->
                    <div id="result-modal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        <div id="result-model-title">Message</div>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection