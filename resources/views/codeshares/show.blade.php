<!--display source code from index-->
@extends('app')

@section('content')
  <!--  <script src="jquery-1.12.0.min.js" type="text/javascript" > </script>
        <script type='text/javascript'>
            function addi()
            {
                var comment=$('#comment').val();
                // var name=$('#name').val();
                $('#sa').prepend('<div class="well" style="width: 80%"><b> <img src="{{ URL::asset('dist/img') }}/{{ Auth::user()->name }}.png" class="user-image" alt="User Image"  width="40" height="40"> {{ Auth::user()->name }} said:</b><br>'+comment+'<br> </div><br></hr>');
            }
        </script>-->

    <div class="container">
        <div class="form-group" style="padding:20px 30px 20px 20px; position: absolute;top: 100px;right: 150px">
            <!--Directs to create to post codes-->
            <a class="btn btn-small btn-info pull-right" href="{{ URL::to('codeshares/create') }}">Post new code</a>
        </div>

        <div class="container" >

            <!--Display code title-->
            <h4><b>{{ $codeshare->title }}</b></h4>
            <br>
            <!--Display code language-->
            <span style='background-color: #5bc0de'><b>{{ $codeshare->language }}</b></span>
            <br>
            <br>

            <!--Display code description-->
            <pre style="width:80%">{{ $codeshare->description }}</pre>

            <br>
            <!--Display source code -->
            <pre style='overflow-y: scroll; height:400px;width: 80%'><code class="javascript">{{ $codeshare->sourceCode }}</code></pre>
            <p style="position: absolute;right: 180px">{{ $codeshare->created_at }}</p>
            <hr/>

            <!--comments form-->
            {!! Form::open(['route' => 'comments.store']) !!}
            <!--get code ID of the displayed code-->
            <input type='hidden' id='codeId' style="width: 0px" name='codeId' value={{ $codeshare->codeId }} >
            <!--get currently logged in user's name-->
            <input type='hidden' id='name' style="width: 0px" name='name' value={{ Auth::user()->name }}  >
            <br>
            <!--display currently logged in user's profile photo-->
            <img src="{{ URL::asset('dist/img') }}/{{ Auth::user()->name }}.png" class="img-circle" alt="User Image" width="50px" height="50px">
            <!--get comment-->
            <input type='text' id='comment' style="width: 800px;height: 35px;padding: 6px 12px;font-size: 14px;" name='comment'  placeholder='Write a comment'>
            <!--store comment-->
            <input type='submit'  id='add' value='Add'  class='btn btn-success'>

            <!--<div id='sa'>

            </div>-->
            <hr/>
            {!! Form::close() !!}
        </div>

        <?php
            //get comments by code ID(displayed code) order by date and time in decsending order
            $comments=DB::table('comments')->where('codeId',$codeshare->codeId)->orderBy('created_at', 'desc')->get();
        ?>
        <!-- Display comments for the spacific code post in most recent from date and time-->
        <div class="container" >
            <?php
               //get all the comments one by one relavent to the displayed code
                foreach($comments as $comment)
                {
                    echo '<tr><td><b style="color: #3f729b">';
            ?>

            <!-- Display profile pic of comment posted user -->
            <img src="{{ URL::asset('dist/img') }}/{{$comment->name }}.png" class="img-circle" alt="User Image" width="35px" height="35px">

             <?php
                    //display commenter's name,comment and comment added date and time
                    echo $comment->name .'</b></td></tr><td>'." ".$comment->comment.'</td><p>'.$comment->created_at.'</p><hr>';
                }
             ?>
        </div>
    </div>

@endsection

