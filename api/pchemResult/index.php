<?php

require("../../lib/core.php");
require("../../functions/pchemresult.php");

$req_id = $_GET["req_id"];
$request = getPchem($req_id);
echo json_encode($request);



?>