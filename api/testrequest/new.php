<?php
 
require("../../lib/core.php");
require("../../functions/testreq.php");

$test_cat = $_POST["test_cat"];
$rwt_num = $_POST["rwt_num"];
$date_rcvd = $_POST["date_rcvd"];
$date_sample = $_POST["date_sample"];
$micro_count = $_POST["micro_count"];
$pchem_count = $_POST["pchem_count"];
$waste_count = $_POST["waste_count"];
$fsa = $_POST["fsa"];
$state = $_POST["state"];
$remarks = $_POST["remarks"];
$client_id = $_POST["client_id"];

// $ds_client_id = $_POST["ds_client_id"];
// $d_jan = isset($_POST['d_jan']) ? $_POST['d_jan'] : '';
// $d_feb = isset($_POST['d_feb']) ? $_POST['d_feb'] : '';
// $d_mar = isset($_POST['d_mar']) ? $_POST['d_mar'] : '';
// $d_apr = isset($_POST['d_apr']) ? $_POST['d_apr'] : '';
// $d_may = isset($_POST['d_may']) ? $_POST['d_may'] : '';
// $d_jun = isset($_POST['d_jun']) ? $_POST['d_jun'] : '';
// $d_jul = isset($_POST['d_jul']) ? $_POST['d_jul'] : '';
// $d_aug = isset($_POST['d_aug']) ? $_POST['d_aug'] : '';
// $d_sept = isset($_POST['d_sept']) ? $_POST['d_sept'] : '';
// $d_oct = isset($_POST['d_oct']) ? $_POST['d_oct'] : '';
// $d_nov = isset($_POST['d_nov']) ? $_POST['d_nov'] : '';
// $d_dec = isset($_POST['d_dec']) ? $_POST['d_dec'] : '';

// newDataSumm($ds_client_id, $d_jan, $d_feb, $d_mar, $d_apr, $d_may, $d_jun,
//                      $d_jul, $d_aug, $d_sept, $d_oct, $d_nov, $d_dec);

newRequest($test_cat, $rwt_num, $date_rcvd, $date_sample, $micro_count, 
			$pchem_count, $waste_count, $fsa, $state, $remarks, $client_id);

$response = array(
	"message" => "Successfully Added",
	"status" => true
);

echo json_encode($response);


?>