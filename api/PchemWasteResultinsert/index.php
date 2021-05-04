<?php

require("../../lib/core.php");
require("../../functions/PchemWasteResultinsert.php");

$req_id = $_GET["req_id"];
$request = getPchemWaste($req_id);
echo json_encode($request);



?>