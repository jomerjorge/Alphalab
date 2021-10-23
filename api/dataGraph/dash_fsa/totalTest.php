<?php
  
require("../../../lib/core.php");
require("../../../functions/dataGraph.php");
 
$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));

$data = totalTest($date_start, $date_end);

echo json_encode($data);
 
?>