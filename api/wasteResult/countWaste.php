<?php

require("../../lib/core.php");
require("../../functions/wasteresult.php");


$req_id = isset($_GET["req_id"]) ? $_GET["req_id"] : "";

$wasteCount = getWasteCount($req_id);

if (count($wasteCount) === 0) {
  $wasteCount = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $wasteCount = array(
    "success" => array(
      "data" => $wasteCount,
      "datafound" => count($wasteCount)
    )
  );
}

echo json_encode($wasteCount);



?>