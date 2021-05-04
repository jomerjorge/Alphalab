<?php

require("../../lib/core.php");
require("../../functions/microresult.php");

$req_id = $_GET["req_id"];
$request = getMicroResult($req_id);
echo json_encode($request);



?>