<?php
  
require("../../lib/core.php");
require("../../functions/reporting.php");

$search_param = isset($_GET["search_param"]) ? $_GET["search_param"] : "";
$search_comp = isset($_GET["search_comp"]) ? $_GET["search_comp"] : "";
$search_analyst = isset($_GET["search_analyst"]) ? $_GET["search_analyst"] : "";
$search_address = isset($_GET["search_address"]) ? $_GET["search_address"] : "";
$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$pagelimit = isset($_GET['pagelimit']) ? $_GET['pagelimit'] : 30;

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));

$offset = $page * $pagelimit - $pagelimit;

$datafound = dataFound_pw($search_param, $search_comp, $search_analyst, $search_address, $date_start, $date_end);
$data = getByPage_pw($search_param, $search_comp, $search_analyst, $search_address, $date_start, $date_end, $pagelimit, $offset);
$totalrecord = countData_pw(); 

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
      "search_param" => $search_param,
      "search_comp" => $search_comp,
      "search_address" => $search_address,
      "search_analyst" => $search_analyst,
      "datafound" => count($datafound),
      "offset" => $offset,
      "totalrecord" => $totalrecord,
      "date_start" => $date_start,
      "date_end" => $date_end
    )
  );
}


echo json_encode($data);
 
?>