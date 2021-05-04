<?php

require("../../lib/core.php");
require("../../functions/pchemresult.php");


$req_id = isset($_GET["req_id"]) ? $_GET["req_id"] : "";

$pchemCount = getPchemCount($req_id);

if (count($pchemCount) === 0) {
  $pchemCount = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $pchemCount = array(
    "success" => array(
      "data" => $pchemCount,
      "datafound" => count($pchemCount)
    )
  );
}

echo json_encode($pchemCount);



?>