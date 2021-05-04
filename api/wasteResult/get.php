<?php

require("../../lib/core.php");
require("../../functions/wasteresult.php");

$pw_id = $_GET["pw_id"];
$request = getWasteByID($pw_id);
echo json_encode($request);


?>