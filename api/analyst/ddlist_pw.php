<?php 

require("../../lib/core.php");
require("../../functions/analyst.php");

$request = getChem_Analyst();
echo json_encode($request);

?>