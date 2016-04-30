@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatable_search/jquery.dataTables.min.css') }}">
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>


@endsection
<?php
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\DB as DB;

$stories=StoryController::getStoriesInProject();

//get project names
$result = DB::table('projects')->get();
$project_id_name = array();
foreach ($result as $res) {
    $project_id_name[$res->ProjectID] = $res->ProjectName;
}
//get developers names
$result_developers = DB::table('users')->where('designation', '=', 'Developer')->get();
$dev_id_name = array();
foreach ($result_developers as $result_developer) {
    $dev_name = $result_developer->name;
    $dev_id = $result_developer->id;
    $dev_id_name[$result_developer->id] = $result_developer->name;

}

$dev_id_name['Not Assigned'] = "Unassigned";



?>


@section('content')
    <br/>
    <div class="container">
        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">
                <div class="panel panel-info">
                    <div class="panel-heading" style="padding:8px 10px 8px 20px;">
                        <h3><b>Search user Stories</b></h3>
                    </div>
                </div>

                <br>

                <table  id="example" class="display" cellspacing="0" width="100%">
                    <thead style="background-color: #cdc1c5">
                    <tr>
                        <th>Story</th>
                        <th>Project name</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Assignee</th>
                        <th>Reporter</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Story</th>
                        <th>Project name</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Assignee</th>
                        <th>Reporter</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($stories as $key => $story)

                            <tr>
                                <td><a href="{{ URL::to('user_stories/' . $story->story_id) }}">{{ $story->story_id }}</a></td>
                                <td>{{ $project_id_name[$story->project_id] }}</td>
                                <td>{{ $story->summary }}</td>
                                <td>{{ $story->priority }}</td>
                                <td><span <?php echo ($story->assignee == "Not Assigned") ? "class='label label-danger'" : "class='label label-warning'"; ?> >{{ $dev_id_name[$story->assignee] }}</span></td>
                                <td>{{ $story->reporter }}</td>
                            </tr>

                    @endforeach
                    </tbody>
                </table>

                <input id="reset_btn" type="reset" value="Reset" style="background-color: #005384 ;font-weight: 900 ;color: #eff7ff">

            </div>
        </div>
    </div>


@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatable_search/jquery.dataTables.min.js') }}"></script>
@endsection

@section('page_script2')
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            var table = $('#example').DataTable();

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                                .search( this.value )
                                .draw();
                    }
                } );
            } );
        } );

        $('#reset_btn').click(function(){
            $('input:text').val('');
            location.reload();
        });
    </script>

@endsection