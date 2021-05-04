<?php

require("../../lib/core.php");
require("../../functions/PchemWasteResultview.php");


$data = pw_view();

if (count($data) === 0) {
  $data = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $data = array(
    "success" => array(
      "data" => $data,
      "datafound" => count($data)
    )
  );
}

echo json_encode($data);

?>