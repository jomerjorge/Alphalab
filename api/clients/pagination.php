<?php
// viewRecords.html
require("../../lib/core.php");
require("../../functions/clients.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";
$searchBy_add_vr = isset($_GET["searchBy_add_vr"]) ? $_GET["searchBy_add_vr"] : "";
$page = isset($_GET['page']) ? $_GET['page'] : ""; 
$pagelimit = isset($_GET['pagelimit']) ? $_GET['pagelimit'] : "";

$offset = $page * $pagelimit - $pagelimit;

$datafound = dataFound($search, $searchBy_add_vr);
$data = getByPage($pagelimit, $offset, $search, $searchBy_add_vr);
$totalrecord = countClients(); 

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
      "search" => $search,
      "search_add" => $searchBy_add_vr,
      "datafound" => count($datafound),
      "offset" => $offset,
      "totalrecord" => $totalrecord
    )
  );
}


echo json_encode($data);
 
?>