<?php

require __DIR__ . '/../../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB as DB;


$results = DB::table('projects')->get();
foreach ($results as $result) {
    $prj_id = $result->project;
    $pmngr=$result->project_manager;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" content="authenticity_token" name="csrf-param">
    <title>Create New Story</title>
</head>
<body>

<section class="content-header">
    <h2>Create New Story</h2>
    <ol class="breadcrumb"></ol>
</section>

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <form id="story-create-form" action="pages/logic/storymanager.php" method="post">
                <input type="hidden" name="operation" value="insert">
                <input type="hidden" name="id" value="null">
                <div class="form-group">
                    Project Name<select class="form-control select2 select2-hidden-accessible" name="pro" style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
                        <?php
                        foreach ($results as $result) {
                            $prj_id = $result->project;
                            $prj_name=$result->project_name;
                            $pmngr = $result->project_manager;

                            echo "<option value = '$prj_id' >$prj_name</option >";
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                Summary<textarea class="form-control" placeholder="Enter ..." rows="3" name="sum" style="width: 50%;"
                          tabindex="2"></textarea>
                </div>

                <div class="form-group">
                    Priority<select class="form-control select2 select2-hidden-accessible" name="pri" style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
                        <option>major</option>
                        <option>minor</option>
                        <option>blocker</option>
                    </select>
                </div>


                <div class="form-group">Due Date
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </div>
                        <input class="form-control" type="text" data-mask="" name="dueD"
                               data-inputmask="'alias': 'dd/mm/yyyy'"
                               style="width: 48.5%;"/>
                    </div>
                </div>
                <div class="form-group">
                    Asignee<select class="form-control select2 select2-hidden-accessible" name="asi" style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
                        <option selected="selected">
                            dev1
                        </option>
                        <option>dev2</option>
                        <option>dev3</option>
                    </select>
                </div>


                <div class="form-group">
                    Reporter<select class="form-control select2 select2-hidden-accessible" name="rep" style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
                        <option selected="selected">
                            PM-1
                        </option>
                        <option>PM-2</option>
                        <option>PM-3</option>
                    </select>
                </div>

                <div class="form-group">
                Description<textarea class="form-control" placeholder="Enter ..." name="des" rows="3" style="width: 50%;"
                          tabindex="2"></textarea>
                </div>

                <div class="form-group">
                    Orginal Estimate<input class="form-control" name="orgEst" type="text" placeholder="Enter original estimate from hours"
                           style="width: 50%;" type="number"/>
                </div>

                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-info" style="width: 20%;">
                        SAVE USER STORY
                    </button>
                    <button type="reset" class="btn btn-block btn-default" style="width: 10%;">
                        RESET
                    </button>
                </div>


            </form>
        </div>
    </div>
</section>

<!-- Page script -->
<script>

    $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();
    });

    $("#story-create-form").submit(function (e) { // catch the form's submit event
        e.preventDefault();
        $.ajax({ // create an AJAX call...
            data: $(this).serialize(), // get the form data
            type: $(this).attr('method'), // GET or POST
            url: $(this).attr('action'), // the file to call
            success: function (response) { // on success..
                //window.alert(response);
                $('#dev-dash-sub-content').html(response); // update the DIV
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
                console.log(jqXHR.responseText);
                console.log(textStatus, errorThrown);
                var warning_out = "<p class='bg-warning'>" + errorThrown + "</p>";
                $('#dev-dash-sub-content').html("Proceed with warnings");
            }
        });
        return false; // cancel original event to prevent form submitting
    });

</script>
</body>
</html>