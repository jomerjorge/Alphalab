<?php

require("../../lib/core.php");
require("../../functions/microWasteresult.php");


$req_id = isset($_GET["req_id"]) ? $_GET["req_id"] : "";

$microWasteCount = getMicroWasteCount($req_id);

if (count($microWasteCount) === 0) {
  $microWasteCount = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $microWasteCount = array(
    "success" => array(
      "data" => $microWasteCount,
      "datafound" => count($microWasteCount)
    )
  );
}

echo json_encode($microWasteCount);



?>