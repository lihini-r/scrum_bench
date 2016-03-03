@extends('app')

@section('content')
    <script src="jquery-1.12.0.min.js" type="text/javascript" > </script>
    <script type='text/javascript'>
        function addi()
        {
            var comment=$('#comment').val();
           // var name=$('#name').val();
            $('#sa').prepend('<div class="well" style="width: 80%"><b> <img src="{{ URL::asset('dist/img') }}/{{ Auth::user()->name }}.png" class="user-image" alt="User Image"  width="40" height="40"> {{ Auth::user()->name }} said:</b><br>'+comment+'<br> </div><br></hr>');
        }
    </script>

    <div class="container">
        <div class="form-group" style="padding:20px 30px 20px 20px; position: absolute;top: 100px;right: 150px">
            <a class="btn btn-small btn-info pull-right" href="{{ URL::to('codeshares/create') }}">Post new code</a>
        </div>

        <div class="container" >
        <b>
            <h4><b>{{ $codeshare->title }}</b></h4>
            <br>
            <span style='background-color: #5bc0de'>
                    {{ $codeshare->language }}
            </span>
        </b>
            <br><br>
            <p>{{ $codeshare->description }}</p>
            <br>
            <div  style='overflow-y: scroll; height:400px;width: 80%'>
                <pre>
                    <code class="javascript">{{ $codeshare->sourceCode }}</code>
                </pre>
            <br>
                {{ $codeshare->created_at }}
        </div>
            <br>
            <hr/>

            {!! Form::open(['route' => 'comments.store']) !!}
            <input type='text' id='codeId' style="width: 40px" name='codeId' value={{ $codeshare->codeId }} >
            <input type='text' id='name' style="width: 40px" name='name' value={{ Auth::user()->name }}  >
            <br>
            <img src="{{ URL::asset('dist/img') }}/{{ Auth::user()->name }}.png" class="img-circle" alt="User Image" width="50px" height="50px">
            <input type='text' id='comment' style="width: 800px;height: 35px;padding: 6px 12px;font-size: 14px;" name='comment'  placeholder='Write a comment'>
            <input type='submit'  id='add' value='Add' onclick='addi();' class='btn btn-success'>
            <br>
            <br>

            <div id='sa'>

            </div>
            <hr/>

            {!! Form::close() !!}
    </div>

        <div class="container" >
        @foreach($comments as $key => $comment)
            <tr>
                <td>{{ $comment->commentId }}</td>
                <td><b>{{ $comment->name .':'}}</b></td>
            </tr>
                <td>{{ $comment->comment }}</td>
            <br>
        @endforeach

        </div>
    </div>

@endsection

