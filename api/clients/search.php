<?php
  
require("../../lib/core.php");
require("../../functions/clients.php");

$description = isset($_GET["description"]) ? $_GET["description"] : "";
$desc_add = isset($_GET["desc_add"]) ? $_GET["desc_add"] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$pagelimit = isset($_GET['pagelimit']) ? $_GET['pagelimit'] : 30;
 
$offset = $page * $pagelimit - $pagelimit;

$datafound = dataFound_c($description, $desc_add);
$data = getByPage_c($description, $desc_add, $pagelimit, $offset);
$totalrecord = count_c(); 

if (count($data) === 0) {
  $data = array(
    "Error" => "No Data Found!"
  );
} 
else {
  $data = array(
    "success" => array(
      "data" => $data,
      "page" => $page,
      "pagelimit" => $pagelimit,
      "fetched" => count($data),
      "description" => $description,
      "desc_add" => $desc_add,
      "datafound" => count($datafound),
      "offset" => $offset,
      "totalrecord" => $totalrecord
    )
  );
}
echo json_encode($data);
 
?>