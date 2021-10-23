<?php
 
require("../../lib/core.php");
require("../../functions/wasteresult.php");

$sample_labelpw = $_POST["sample_labelpw"];
$water_despw = $_POST["water_despw"];
$pw_paramr = $_POST["pw_param"];
$req_id = $_POST["req_id"];

	foreach ($pw_paramr as $pw_param) {
			newWaste($sample_labelpw, $water_despw, $pw_param, $req_id);
			}

$response = array(
	"message" => "Successfully Added",
	"status" => true
);

echo json_encode($response);

?>