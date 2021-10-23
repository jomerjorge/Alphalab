<?php
  
require("../../lib/core.php");
require("../../functions/PchemWasteResultview.php");
 
$search_rwt = isset($_GET["search_rwt"]) ? $_GET["search_rwt"] : "";

$datafound = dataFound($search_rwt);
$data = searchRWT($search_rwt);

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
      "search_rwt" => $search_rwt,
      "datafound" => count($datafound)
      // "client_id" => $client_id,
      // "req_id" => $req_id
    )
  );
}

echo json_encode($data);
 
?>