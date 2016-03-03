@extends('app')
<style>
    .text-width {
        width: 50%;
    }
</style>
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
            {!! Form::open(array('url' => 'send_issues_email.php')) !!}
            <form name="issues" method="post" action="send_issues_email.php" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group" style="position: absolute;left: 420px;top: 230px;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="email1">Email</label>
                <br>
                <input type="email" class="form-control" id="email1" name="email1" placeholder="From">
                <br>
                <label for="subject1">Subject</label>
                <br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" class="form-control" id="subject1" name="subject1" placeholder="Subject">
                <br>
                <label for="editor1">Message</label>

            </div>


            <section class="content" >
                <h1>
                    Issues

                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Email</a></li>
                    <li class="active">Issues</li>
                </ol>
                <div class="row" style="position: absolute;top: 420px;left:420px">
                    <div class="col-md-12">
                        <div class="box box-info">


                            <!-- tools box -->
                            <div class="pull-right box-tools">
                            </div><!-- /. tools -->

                            <div class="box-body pad">

                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                           Type your message here.
                    </textarea>

                            </div>
                        </div><!-- /.box -->


                    </div><!-- /.col-->
                </div><!-- ./row -->
            </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <div class="form-group" style="position: absolute;top: 800px;left: 420px">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile" name="exampleInputFile">

    </div>

    <button type="submit" class="btn btn-success" style="position: absolute;top: 720px;left: 420px"> Send </button>

    </form>

@endsection