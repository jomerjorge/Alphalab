<?php

require("../../lib/core.php");
require("../../functions/filterSearch_micro_func.php");


$data = view_hold();

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