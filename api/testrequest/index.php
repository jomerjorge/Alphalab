<?php

require("../../lib/core.php");
require("../../functions/testreq.php");

$client_id = $_GET["client_id"];
$request = getRequest($client_id);
echo json_encode($request);



?>