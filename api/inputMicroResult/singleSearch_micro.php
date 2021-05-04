<?php 

require("../../lib/core.php");
require("../../functions/filterSearch_micro_func.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";

$datafound = dataFound_s($search);
$data = getMicroRes_S($search);

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
      "search" => $search,
      "datafound" => count($datafound)
    )
  );
}

echo json_encode($data);


 ?>