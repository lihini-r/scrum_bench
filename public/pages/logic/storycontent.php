<?php
/**
 * Created by PhpStorm.
 * User: Lihini Avanthika
 * Date: 1/24/2016
 * Time: 11:24 AM
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

$project = "";
$summary = "";
$description = "";
$priority = "";
$orgEST = "";
$due_date = "";

$assignee = "";
$reporter = "";

foreach ($result as $res) {
    $project = $res->project;
    $summary = $res->sumary;
    $description = $res->description;
    $priority = $res->priority;
    $orgEST = $res->org_estimate;
    $due_date = $res->dueDate;
    $assignee = $res->asignee;
    $reporter = $res->reporter;
}

?>

<html>
<head>
    <!-- Following style is to change mouse over color of nav-pills -->
    <style>
        .nav-pills > li > a:hover {
            text-decoration: none;
            background-color: rgba(76, 173, 227, 0.55);
        }
    </style>
</head>

<section class="content-header">
    <h2><?php echo $id; ?></h2>
</section>

<section class="content">

    <ul class="nav nav-pills">
        <li role="presentation"><a href="#"
                                   onclick="loadOnLinkClick('pages/logic/edituserstory.php?id=<?php echo $id; ?>')">Edit</a>
        </li>
        <li role="presentation"><a href="#" data-toggle="modal" data-target="#assign-me">Assign To Me</a></li>
        <li role="presentation"><a href="#" data-toggle="modal" data-target="#work-log">WorkLog</a></li>
    </ul>

    <br/><br/><br/>

    <div class="row">
        <div class="col-sm-6">
            <table class="table">
                <tbody>
                <tr>
                    <td>Project</td>
                    <td><?php echo $project; ?></td>
                </tr>
                <tr>
                    <td>Summary</td>
                    <td><?php echo $summary; ?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo $description; ?></td>
                </tr>
                <tr>
                    <td>Priority</td>
                    <td><?php echo $priority; ?></td>
                </tr>
                <tr>
                    <td>Original Estimate</td>
                    <td><?php echo $orgEST; ?></td>
                </tr>
                <tr>
                    <td>Due Date</td>
                    <td><?php echo $due_date; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-4">
            <table class="table pull-right">
                <tbody>
                <tr>
                    <td><a href="#" data-toggle="modal" data-target="#assign-me">Assignee</td>
                    <td><?php echo $assignee; ?></td>
                </tr>
                <tr>
                    <td>Reporter</td>
                    <td><?php echo $reporter; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>


<!--Work Log Modal -->
<div id="work-log" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Log Your Work</h4>
            </div>
            <div class="modal-body">
                Description
                <textarea class="form-control" placeholder="Enter ..." rows="3" name="sum" style="width: 100%;"
                          tabindex="2"></textarea>
                Worked hours
                <input class="form-control" name="orgEst" type="text" placeholder="Enter in hours"
                       style="width: 50%;"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
            </div>
        </div>

    </div>
</div>

<!--Assign to me Modal -->
<div id="assign-me" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Story Assignment</h4>
            </div>
            <div class="modal-body">
                <p>Select developer</p>

                <select>
                    <option value="" disabled="disabled" selected="selected">Please select a name</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>

    </div>
</div>

</html>
