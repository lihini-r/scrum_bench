<?php
/**
 * Created by PhpStorm.
 * User: Lihini Avanthika
 * Date: 1/24/2016
 * Time: 5:33 PM
 */

require __DIR__ . '/../../../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../../../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB as DB;


$id = $_GET['id'];
$result = DB::table('userstories')->where('story_id', '=', $id)->get();

$summary = "";
$description = "";
$orgEST = "";
$due_date = "";
$prj_id="";
$prio="";
$pm="";

foreach ($result as $res) {
    $summary = $res->sumary;
    $description = $res->description;
    $orgEST = $res->org_estimate;
    $due_date = $res->dueDate;
    $prj_id=$res->project;
    $prio=$res->priority;
}
$names = DB::table('projects')->where('project', '=', $prj_id)->get();

foreach ($names as $name) {
    $prj_name = $name->project_name;
    $pm=$name->project_manager;

}

?>

<html>

<section class="content-header">
    <h2><?php echo $id." (Edit)"; ?></h2>
</section>

<section class="content">
    <form id="story-edit-form" action="pages/logic/storymanager.php" method="post">
        <input type="hidden" name="operation" value="edit">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            Project<select class="form-control select2 select2-hidden-accessible" name="pro" style="width: 50%;"
                           tabindex="-1"
                           aria-hidden="true">
                <option value="<?php echo $prj_id; ?>" selected="selected">
                    <?php echo $prj_name; ?>
                </option>


            </select>
        </div>


        <div class="form-group">major
            Summary<textarea class="form-control" placeholder="Enter ..." rows="3" name="sum"
                             style="width: 50%;"
                             tabindex="2"><?php echo $summary; ?></textarea>
        </div>

        <div class="form-group">
            Priority<select class="form-control select2 select2-hidden-accessible" name="pri"
                            style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">

                <option ><?php echo $prio; ?></option>



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
                       style="width: 48.5%;" value="<?php echo $due_date; ?>"/>

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
            Reporter<select class="form-control select2 select2-hidden-accessible" name="rep"
                            style="width: 50%;"
                            tabindex="-1"
                            aria-hidden="true">
                <option selected="selected" value="<?php echo $prj_id; ?>">
                    <?php echo $pm ; ?>
                </option>



            </select>
        </div>

        <div class="form-group">
            Description<textarea class="form-control" placeholder="Enter ..." name="des" rows="3"
                                 style="width: 50%;"
                                 tabindex="2"><?php echo $description; ?></textarea>
        </div>

        <div class="form-group">
            Orginal estimate<input class="form-control" name="orgEst" type="text" placeholder=""
                                   style="width: 50%;" value="<?php echo $orgEST; ?>"/>
        </div>

        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-info" style="width: 20%;">
                UPDATE USER STORY
            </button>

        </div>

    </form>
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
    $("#story-edit-form").submit(function (e) { // catch the form's submit event
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

</html>
