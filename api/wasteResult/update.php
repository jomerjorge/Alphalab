<?php

require("../../lib/core.php");
require("../../functions/wasteresult.php");

$sample_labelpw = $_POST["sample_labelpw"];
$water_despw = $_POST["water_despw"];
$pw_paramr = $_POST["pw_param"];
$pw_met = $_POST["pw_met"];
$pw_result = $_POST["pw_result"];
$pw_analyst = $_POST["pw_analyst"];
$req_id = $_POST["req_id"];
$result_id = $_POST["result_id"];

foreach ($param_idr as $param_id) 
{
	updateWaste($sample_labelpw, $water_despw, $pw_param, $pw_met, $pw_result, $pw_analyst, $req_id, $pw_id);
}

$response = array(
    "message" => "Successfully Updated!",
    "status" => true
);

echo json_encode($response);



?>