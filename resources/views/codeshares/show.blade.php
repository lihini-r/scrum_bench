<!--display source code from index-->
@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        .text-width {
            width: 50%;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="container" >
            @if(Auth::user()->name == $codeshare->userName)
                <a class="glyphicon glyphicon-pencil " style="position: absolute;right:180px;top: 160px; " href="#" data-toggle="modal" data-target="#edit_code"></a>
                @endif
                        <!-- Edit Code-->
                <div id="edit_code" class="modal fade" role="dialog">
                    <div class="modal-dialog" >
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#337ab7">
                                <!-- Modal button to close form-->
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="color: white"><b>Update Your Post</b></h4>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <!-- Update code-->
                                            {!! Form::model($codeshare, ['method' => 'PATCH','route' => ['codeshares.update', $codeshare->codeId   ], 'data-toggle' => 'validator']) !!}

                                            <div class="form-group">
                                                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                                                <input value="{{$codeshare->title }}" type="text" class="form-control" style="width:100%;" name="title"  id="title"  >

                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('language', 'Language', ['class' => 'control-label']) !!}
                                                <select id="language" name="language" class="form-control" style="width: 250px">
                                                    <option>C</option>
                                                    <option>C#</option>
                                                    <option>C++</option>
                                                    <option> CSS</option>
                                                    <option> HTML</option>
                                                    <option>Java</option>
                                                    <option>JavaScript</option>
                                                    <option>MatLab</option>
                                                    <option> Objective-C</option>
                                                    <option>Pascal</option>
                                                    <option>Perl</option>
                                                    <option>PHP</option>
                                                    <option>Python</option>
                                                    <option>Ruby</option>
                                                    <option>SQL</option>
                                                    <option>XML</option>
                                                </select >
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                                                <textarea  id="description" name="description" class="form-control" rows="2" cols="50" style="width: 500px;" > {{ $codeshare->description }} </textarea>
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('sourceCode', 'Source Code', ['class' => 'control-label']) !!}
                                                <textarea  id="sourceCode" name="sourceCode" rows="10" cols="40" style='width: 450px;overflow-y: scroll;' class="form-control">{{ $codeshare->sourceCode }} </textarea>

                                            </div>

                                            <div class="modal-footer">
                                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                                {!! Form::close() !!}
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Display selected code Post-->
                <h4><b>{{ $codeshare->title }}</b></h4>
                <input type='hidden' id='userName' style="width: 60px" name='codeId' value={{$codeshare->userName }}>
                <br>
                <span style='background-color: #5bc0de'><b>{{ $codeshare->language }}</b></span>
                <br>
                <br>


                <pre style="width:80%;">{{ $codeshare->description }}</pre>

                <br>
                <pre style='overflow-y: scroll; height:400px;width: 80%'><code class="javascript">{{ $codeshare->sourceCode }}</code></pre>
                <p style="position: absolute;right: 180px">{{ $codeshare->created_at }}</p>
                <hr/>

                <!-- form to add comments-->
                {!! Form::open(['route' => 'comments.store']) !!}
                <input type='hidden' id='codeId' style="width: 0px" name='codeId' value={{ $codeshare->codeId }} >
                <input type='hidden' id='name' style="width: 0px" name='name' value="{{ Auth::user()->name }}"  >
                <br>
                <img src="{{ URL::asset('dist/img') }}/{{ Auth::user()->name }}.png" class="img-circle" alt="User Image" width="50px" height="50px">
                <input type='text' id='comment' style="width: 800px;height: 35px;padding: 6px 12px;font-size: 14px;" name='comment'  placeholder='Write a comment'>
                <input type='submit'  id='add' value='Add'  class='btn btn-success'>
                <hr/>
                {!! Form::close() !!}
        </div>

        <?php
        $comments=DB::table('comments')->where('codeId',$codeshare->codeId)->orderBy('created_at', 'desc')->get();
        ?>
                <!-- Display comments for the spacific code post in most recent from date and time-->
        <div class="container" >
            <?php
            foreach($comments as $comment)
            {
            echo '<tr><td><b style="color: #3f729b">';
            ?>

            <img src="{{ URL::asset('dist/img') }}/{{$comment->name }}.png" class="img-circle" alt="User Image" width="35px" height="35px">

            <?php
            echo $comment->name .'</b></td></tr><td>'." ".$comment->comment.'</td><p>'.$comment->created_at.'</p><hr>';
            }
            ?>
        </div>
    </div>

@endsection

@section('page_script1')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
@endsection

