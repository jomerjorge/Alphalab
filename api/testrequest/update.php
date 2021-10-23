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
$req_id = $_POST["req_id"];

updateRequest($test_cat, $rwt_num, $date_rcvd, $date_sample, $micro_count, $pchem_count,
			  $waste_count, $fsa, $state, $remarks, $client_id, $req_id);

$response = array(
    "message" => "Successfully Updated!",
    "status" => true
);

echo json_encode($response);



?>