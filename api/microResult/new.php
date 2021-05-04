<?php
//insert.php
 
require("../../lib/core.php");
require("../../functions/microresult.php");

$sam_param = $_POST["sam_param"];
$sample_label = $_POST["sample_label"];
$water_des = $_POST["water_des"];
$sam_point = $_POST["sam_point"];
$sam_place = $_POST["sam_place"];
$tc_potable = $_POST["tc_potable"];
$thc_potable = $_POST["thc_potable"];
$hpc_result = $_POST["hpc_result"];
$ec_result = $_POST["ec_result"];
$tc_waste = $_POST["tc_waste"];
$fc_waste = $_POST["fc_waste"];
$remarks = $_POST["remarks"];
$req_id = $_POST["req_id"];

addMicro($sam_param, $sample_label, $water_des, $sam_point, $sam_place, $tc_potable, $thc_potable, $hpc_result, 
		 $ec_result, $tc_waste, $fc_waste, $remarks, $req_id);

$response = array(
  "message" => "Successfully Added",
  "status" => true
);

echo json_encode($response);


?>