<?php
  
require("../../lib/core.php");
require("../../functions/reporting.php");

$search_com_ml = isset($_GET["search_com_ml"]) ? $_GET["search_com_ml"] : "";
$search_add_ml = isset($_GET["search_add_ml"]) ? $_GET["search_add_ml"] : "";
$search_bstyle = isset($_GET["search_bstyle"]) ? $_GET["search_bstyle"] : "";
$search_afsa = isset($_GET["search_afsa"]) ? $_GET["search_afsa"] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$pagelimit = isset($_GET['pagelimit']) ? $_GET['pagelimit'] : 50;

$offset = $page * $pagelimit - $pagelimit;

$datafound = dataFound_mL($search_com_ml, $search_add_ml, $search_bstyle, $search_afsa);
$data = getByPage_mL($search_com_ml, $search_add_ml, $search_bstyle, $search_afsa, $pagelimit, $offset);
$totalrecord = count_mL(); 

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
      "search_com_ml" => $search_com_ml,
      "search_add_ml" => $search_add_ml,
      "search_bstyle" => $search_bstyle,
      "search_afsa" => $search_afsa,
      "datafound" => count($datafound),
      "offset" => $offset,
      "totalrecord" => $totalrecord
    )
  );
}


echo json_encode($data);
 
?>