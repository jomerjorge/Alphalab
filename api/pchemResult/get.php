<?php

require("../../lib/core.php");
require("../../functions/pchemresult.php");

$pw_id = $_GET["pw_id"];
$request = getPchemByID($pw_id);
echo json_encode($request);


?>