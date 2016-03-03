@extends('app')




@section('content')
    <br/>

    <div class="container">
    <div class="form-group" style="padding:20px 30px 20px 20px;">

        @foreach($prjman as $key =>$pm)

            <h1 style="color: #00a65a" ><b>{{$pm->ProjectName}} Project</b></h1>

        @endforeach


                <div class="col-md-7" style="background-color: #99ee99">
                    <br>
                    <table class="table table-striped" style="background-color: #ddffdd">

                        <tbody>

                        @foreach($projects as $key =>$pro)

                            <tr><td>Description</td>
                            <td>{{$pro->Description }}</td></tr>

                        <tr><td> State</td>
                            <td>{{ $pro->State }}</td></tr>

                        <tr><td> Added Date</td>
                            <td>{{ $pro->add_date }}</td></tr>


                        <tr><td> Due Date</td>
                            <td>{{ $pro->due_date }}</td></tr>

                        @endforeach

                        </tbody>
                    </table>




                </div>

    </div>


    </div>
    <br><br>






<!--Display Teams-->


        <div class="col-md-12">
            <div class="row">




            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">

                   <div class="inner">

                         <h3>Team A</h3>
                   </div>


                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>

               <a class="small-box-footer" href="#">
                More Info..
               <i class="fa fa-arrow-circle-right"></i>
               </a>

                </div>

            </div>




            <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">

                <div class="inner">

                    <h3>Team B</h3>
                </div>


                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>

                <a class="small-box-footer" href="#">
                    More Info..
                    <i class="fa fa-arrow-circle-right"></i>
                </a>

            </div>

        </div>













        </div>
        </div>
    </div>


@endsection