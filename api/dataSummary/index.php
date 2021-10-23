<?php

require("../../lib/core.php");
require("../../functions/datasummary.php");

// $client_id = $_GET["client_id"];
$request = getSummary();
echo json_encode($request);



?>