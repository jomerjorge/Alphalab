<?php
  
require("../../lib/core.php");
require("../../functions/user_log_activity.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";
$page = isset($_GET['page']) ? $_GET['page'] : ""; 
$pagelimit = isset($_GET['pagelimit']) ? $_GET['pagelimit'] : "";
 
$offset = $page * $pagelimit - $pagelimit;

$datafound = dataFound($search);
$data = getByPage($pagelimit, $offset, $search);
$totalrecord = countUser(); 

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
      "datafound" => count($datafound),
      "offset" => $offset,
      "totalrecord" => $totalrecord
    )
  );
}


echo json_encode($data);
 
?>