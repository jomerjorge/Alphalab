<?php 

require("../../lib/core.php");
require("../../functions/analyst.php");

$request = getMicro_Analyst();
echo json_encode($request);

?>