<?php
/**
 * Created by PhpStorm.
 * User: Lihini Avanthika
 * Date: 1/24/2016
 * Time: 10:44 AM
 */


require __DIR__ . '/../../../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../../../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB as DB;

$table_prefix = "<table class=\"table table-hover\"><thead><tr><th>Story Id</th><th>Summary</th><th>Assignee</th></tr></thead><tbody>";
$table_suffix = "</tbody></table>";
$row_prefix = "<tr><td>";
$row_separator = "</td><td>";
$row_suffix = "</td></tr>";

$userstories = DB::table('userstories')->get();

echo "<h2>Backlog</h2>";

echo $table_prefix;
foreach ($userstories as $userstory) {
    echo $row_prefix . "<a href='#' onclick=\"loadOnLinkClick('pages/logic/storycontent.php?id=" . $userstory->story_id . "')\"><span>" . $userstory->story_id . "</span></a>" . $row_separator . $userstory->sumary . $row_separator . $userstory->asignee . $row_suffix;
}
echo $table_suffix;

?>