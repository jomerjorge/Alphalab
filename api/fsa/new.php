<?php 

require("../../lib/core.php");
require("../../functions/fsa.php");

$fsa_name = $_POST["fsa_name"];
$fsa_status = $_POST["fsa_status"];

add_fsa($fsa_name, $fsa_status);

$response = array(
	"message" => "New FSA has been successfully added.",
	"status" => true
);

echo json_encode($response);


?> 