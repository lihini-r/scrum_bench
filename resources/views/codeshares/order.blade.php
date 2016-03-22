@extends('app')

@section('content')

    <div class="form-group" style="padding:20px 30px 20px 20px;">
        <h1>Search</h1>
        <a class="btn btn-small btn-success pull-right glyphicon-plus" style="position: absolute;right:170px; " href="#" data-toggle="modal" data-target="#send-messages">Search</a>

        <div id="send-messages" class="modal fade" role="dialog">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#337ab7">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: white"><b>SEARCH</b></h4>
                    </div>
                    <div class="modal-body">
                        <section class="content">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    {!! Form::open(['route' => 'codeshares.order']) !!}
                                    <div class="form-group">
                                        {!! Form::label('search', 'Search', ['class' => 'control-label']) !!}

                                        <input type='text' id='search' style="width: 200px" name='search'  >
                                        <select class="form-control select2 select2-hidden-accessible"
                                                id='sort' name='sort' style="width: 50%;"
                                                tabindex="-1"
                                                aria-hidden="true">
                                            <option>desc</option>
                                            <option>asc</option>

                                        </select>

                                    </div>





                                    <div class="modal-footer">
                                        {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection