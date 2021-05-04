<?php

require("../../lib/core.php");
require("../../functions/PchemWasteResultinsert.php");

$req_id = $_GET["req_id"];
$request = pwsingleview($req_id);
echo json_encode($request);



?>