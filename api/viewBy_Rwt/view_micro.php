<?php
  
require("../../lib/core.php");
require("../../functions/viewBy_Rwt.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";


$data = view_by_micro($search);

if (count($data) === 0) {
  $data = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $data = array(
    "success" => array(
      "data" => $data
    )
  );
}

echo json_encode($data);
 
?>