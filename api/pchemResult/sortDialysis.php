<?php

require("../../lib/core.php");
require("../../functions/pchemresult.php");

$req_id = $_GET["req_id"];
$request = sortDialysis($req_id);
echo json_encode($request);



?>