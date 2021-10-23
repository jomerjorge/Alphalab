<?php
  
require("../../lib/core.php");
require("../../functions/reporting.php");

$search_comp = isset($_GET["search_comp"]) ? $_GET["search_comp"] : "";
$search_add = isset($_GET["search_add"]) ? $_GET["search_add"] : "";
$search_analyst_mc = isset($_GET["search_analyst_mc"]) ? $_GET["search_analyst_mc"] : "";
$search_fsa = isset($_GET["search_fsa"]) ? $_GET["search_fsa"] : "";
$search_bstyle = isset($_GET["search_bstyle"]) ? $_GET["search_bstyle"] : "";
$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$pagelimit = isset($_GET['pagelimit']) ? $_GET['pagelimit'] : 40;

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));

$offset = $page * $pagelimit - $pagelimit;

$datafound = dataFound_mw($search_comp, $search_add, $search_analyst_mc, $search_fsa, $search_bstyle, $date_start, $date_end);
$data = getByPage_mw($search_comp, $search_add, $search_analyst_mc, $search_fsa, $search_bstyle, $date_start, $date_end, $pagelimit, $offset);
$totalrecord = countData_mw(); 

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
      "search_comp" => $search_comp,
      "search_add" => $search_add,
      "search_analyst_mc" => $search_analyst_mc,
      "search_fsa" => $search_fsa,
      "search_bstyle" => $search_bstyle,
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