<?php

require("../../lib/core.php");
require("../../functions/wasteresult.php");

$req_id = $_GET["req_id"];
$request = getWaste($req_id);
echo json_encode($request);



?>