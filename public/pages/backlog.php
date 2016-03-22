<?php

require __DIR__ . '/../../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" content="authenticity_token" name="csrf-param">
    <title>Backlog</title>
</head>
<body>

<div class="form-group" style="padding:20px 30px 20px 20px;">
    <button class="btn btn-block btn-info pull-right" style="width: 10%;"
            onclick="loadOnButtonClick('pages/createUserStory.php')">
        CREATE
    </button>	
</div>

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <div id="dev-dash-sub-content">

            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#dev-dash-sub-content').load('pages/logic/storyviewer.php');
    });
</script>
</body>
</html>