
@extends('app')


@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('../../../public/plugins/multiple-Select/multiple-select.css') }}">

    <script type="text/javascript" src="{{ URL::asset('../../../public/plugins/multiple-Select/multiple-select.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('../../../public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>


    <link rel="stylesheet" href="{{ URL::asset('../../../public/plugins/multiple-Select/assets/bootstrap/css/bootstrap.css') }}">


@endsection




@section('content')
    <br/>
    <br/>
    <br/>
    <div class="container">

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



        <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
            <div class="box-header with-border">

                <div class="panel panel-info">

                    <div class="panel-heading" style="padding: 8px 10px 8px 20px ;">

                        <h1 style="color: #00a157">Assign Teams</h1>
                    </div>

                </div>





                <div class="col-md-6" style="background-color: #7adddd">

                        <br>

                        {!! Form::open(['route' => 'assign_teams.store']) !!}



                        <div class="form-group">

                            @foreach($projects as $key =>$pm)


                               <b>Project Name :</b>
                                <br>
                                <input   type="text" value='{{$pm->ProjectName}}' style="width: 50%" readonly="readonly">

                            @endforeach



                                @foreach($projects as $key =>$pro)

                                    <input hidden  type="text" value='{{$pro->ProjectID}}' name="ProjectName">



                                    @endforeach

                                    </div>



                        <div class="form-group">

                            <label>Select Teams</label>
                            <br>


                            <?php
                            use \App\Team;
                            use  Illuminate\Support\Facades\DB as DB;


                            foreach($projects as $key =>$pro)

                              {
                                  $proid= $pro->ProjectID;

                            $team_ids =array();

                            $assigned =DB::table('assign_teams')->where('ProjectID',$proid)->get();

                                foreach($assigned as $item)
                                  {
                                      array_push($team_ids, $item->team_id);
                                  }


                                foreach($team_ids as $tid)
                                {

                                    $teams=Team::all();

                                }

                                  $team =array();

                                  $assigned_teams=array();

                                  foreach($teams as $t)
                                  {
                                      $tname=$t->TeamName;

                                      if (in_array($t->team_id, $team_ids)) {


                                      } else {



                                          $teams[$t->team_id]=$t->team_id;



                                          array_push($team,  $teams[$t->team_id]);


                                          $id=$teams[$t->team_id];

                                           echo "<input tabindex='1' type='checkbox' name='teams[]' id='$id' value='$id' /> ";



                                          echo $tname;
                                          echo "<br>";
                                      }



                                  }




                              }
                            ?>


                        </div>












                        {!! Form::submit('Assign Teams', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}

                        <br>
                    </div>

                </div>
            <br>
</div>
    </div>

@endsection

