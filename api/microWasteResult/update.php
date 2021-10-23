<?php
//update.php
 
require("../../lib/core.php");
require("../../functions/microWasteresult.php");

$sam_param = $_POST["sam_param"];
$sample_label = $_POST["sample_label"];
$water_des = $_POST["water_des"];
$sam_place = $_POST["sam_place"];
$tc_waste = $_POST["tc_waste"];
$fc_waste = $_POST["fc_waste"];
$micro_id = $_POST["micro_id"];
$req_id = $_POST["req_id"];

updateMicroWaste($sam_param, $sample_label, $water_des, $sam_place, $tc_waste, $fc_waste, $micro_id, $req_id);

$response = array(
  "message" => "Successfully Updated",
  "status" => true
);

echo json_encode($response);


?>