<?php

require("../../lib/core.php");
require("../../functions/microWasteresult.php");

$req_id = $_GET["req_id"];
$request = getMicroWasteResult($req_id);
echo json_encode($request);



?>