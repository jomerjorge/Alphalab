<?php
 
require("../../lib/core.php");
require("../../functions/pchemresult.php");

$sample_labelpw = $_POST["sample_labelpw"];
$water_despw = $_POST["water_despw"];
$sam_pointp = $_POST["sam_pointp"];
$pw_paramr = $_POST["pw_param"];
$req_id = $_POST["req_id"];


	foreach ($pw_paramr as $pw_param)
	{
		newPchem($sample_labelpw, $water_despw, $sam_pointp, $pw_param, $req_id);
	}

$response = array(
	"message" => "Successfully Added",
	"status" => true,
	"data" => $pw_paramr
);

echo json_encode($response);

?>