<?php
//insert.php
 
require("../../lib/core.php");
require("../../functions/microWasteresult.php");

$sam_param = $_POST["sam_param"];
$sample_label = $_POST["sample_label"];
$water_des = $_POST["water_des"];
$sam_place = $_POST["sam_place"];
$remarks = $_POST["remarks"];
$tc_potable = $_POST["tc_potable"];
$thc_potable = $_POST["thc_potable"];
$hpc_result = $_POST["hpc_result"];
$ec_result = $_POST["ec_result"];
$tc_waste = $_POST["tc_waste"];
$fc_waste = $_POST["fc_waste"];
$req_id = $_POST["req_id"];

addMicroWaste($sam_param, $sample_label, $water_des, $sam_place, $tc_potable,
			  $thc_potable, $hpc_result, $ec_result, $tc_waste, $fc_waste, $remarks, $req_id);

$response = array(
  "message" => "Successfully Added",
  "status" => true
);

echo json_encode($response);


?>