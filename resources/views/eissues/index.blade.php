@extends('app')

@section('content')

    <br/>

    <div class="form-group" style="padding:20px 30px 20px 20px;">

        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('eissues/create') }}">Create New Sprint</a>
    </div>
    <br/>
    <br/>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Email From</td>
                <td> Subject</td>
                <td>Message</td>

            </tr>
            </thead>
            <tbody>
            @foreach($eissues as $key => $eissue)
                <tr>
                    <td>{{ $eissue->emailFrom }}</td>
                    <td>{{ $eissue->subject }}</td>
                    <td>{{ $eissue->message }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection