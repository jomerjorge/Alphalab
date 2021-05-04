<?php
  
require("../../lib/core.php");
require("../../functions/analyst.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";

$data = view_analyst($search);

if (count($data) === 0) {
  $data = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $data = array(
    "success" => array(
      "data" => $data,
      "fetched" => count($data),
      "search" => $search
    )
  );
}

echo json_encode($data);
 
?>