<?php
/**
 * Created by PhpStorm.
 * User: Lihini Avanthika
 * Date: 1/23/2016
 * Time: 4:00 PM
 */

require __DIR__ . '/../../../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../../../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB as DB;

// only used for edit
$id = $_POST['id'];

// common for insert and edit
$pro = $_POST['pro'];
$sum = $_POST['sum'];
$pri = $_POST['pri'];
$dueD = $_POST['dueD'];
$asi = $_POST['asi'];
$rep = $_POST['rep'];
$des = $_POST['des'];
$orgEst = $_POST['orgEst'];
$op = $_POST['operation'];

$info_panel_prefix = "<div class=\"panel panel-success\"><div class=\"panel-heading\">Operation Succeeded</div><div class=\"panel-body\">";
$info_panel_suffix = "</div></div>";

if (strcmp($op,'insert')==0) {
    $date = new DateTime();
    $tstmp = $date->format('U');
    $storyId = $pro . "-" . $tstmp;
    DB::insert('insert into userstories (project, sumary, priority, dueDate, asignee, reporter, description, org_estimate, story_id) values (?,?,?,?,?,?,?,?,?)', [$pro, $sum, $pri, $dueD, $asi, $rep, $des, $orgEst, $storyId]);
    echo $info_panel_prefix . "New User Story Created Successfully - [" . $storyId . "]" . $info_panel_suffix;
} else if (strcmp($op,'edit')==0) {
    $affected = DB::table('userstories')
        ->where('story_id', '=', $id)
        ->update(array('project' => $pro, 'sumary' => $sum, 'priority' => $pri, 'dueDate' => $dueD, 'asignee' => $asi, 'reporter' => $rep, 'description' => $des, 'org_estimate' => $orgEst));
    echo $info_panel_prefix . "User Story [" . $id . "] Updated Successfully" . $info_panel_suffix;
}

?>