<?php 

require("../../lib/core.php");
require("../../functions/filterSearch_microWaste_func.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";
$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));

$datafound = dataFound($search, $date_start, $date_end);
$data = getMicroWasteRes($search, $date_start, $date_end);

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
      "datafound" => count($datafound),
      "date_start" => $date_start,
      "date_end" => $date_end
    )
  );
}

echo json_encode($data);


 ?>