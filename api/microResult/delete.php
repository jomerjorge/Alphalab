<?php

require("../../lib/core.php");
require("../../functions/microresult.php");

$micro_id = $_POST["micro_id"];
removeMicro($micro_id);

$response = array(
	"message" => "Deleted Successfully",
	"status" => true
);

echo json_encode($response);


?>