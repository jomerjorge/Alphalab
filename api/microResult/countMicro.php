<?php

require("../../lib/core.php");
require("../../functions/microresult.php");


$req_id = isset($_GET["req_id"]) ? $_GET["req_id"] : "";

$microCount = getMicroCount($req_id);

if (count($microCount) === 0) {
  $microCount = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $microCount = array(
    "success" => array(
      "data" => $microCount,
      "datafound" => count($microCount)
    )
  );
}

echo json_encode($microCount);



?>