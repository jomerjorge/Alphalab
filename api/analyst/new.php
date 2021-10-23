<?php 

require("../../lib/core.php");
require("../../functions/analyst.php");

$analyst_name = $_POST["analyst_name"];
$analyst_dept = $_POST["analyst_dept"];
$analyst_status = $_POST["analyst_status"];

add_analyst($analyst_name, $analyst_dept, $analyst_status);

$response = array(
	"message" => "New analyst has been successfully added.",
	"status" => true
);

echo json_encode($response);


?> 