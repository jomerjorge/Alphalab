<?php 

require("../../lib/core.php");
require("../../functions/analyst.php");

$request = getChem_Analyst_inac();
echo json_encode($request);

?>