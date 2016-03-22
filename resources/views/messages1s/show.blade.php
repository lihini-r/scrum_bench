@extends('app')

@section('content')
    <?php
        //get messages from messages1s order by date and time in descending order-to get the latest message first
        $messages1s=DB::table('messages1s')->where('from',$messages1->from)->orderBy('created_at', 'asc')->get();
    ?>
    <div class="container">
        <?php
            foreach($messages1s as $key => $messages1)
            {
                echo '<div class="container" >
                      <b><h4><b>';
        ?>
         <!--display sender's user image user name and -->
        <img src="{{ URL::asset('dist/img') }}/{{ $messages1->from }}.png" class="img-circle" alt="User Image" width="40px" height="40px">

        <?php
            echo $messages1->from.   '</b></h4><br></b><pre>' //display message sender
                .$messages1->message.'</pre></a><p> '         //display messsage
                .$messages1->created_at .'<hr/></div>';       //display message sent time and date
            }
        ?>
    </div>
@endsection