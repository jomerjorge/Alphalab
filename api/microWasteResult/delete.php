<?php

require("../../lib/core.php");
require("../../functions/microWasteresult.php");

$micro_id = $_POST["micro_id"];
removeMicroWaste($micro_id);

$response = array(
	"message" => "Deleted Successfully",
	"status" => true
);

echo json_encode($response);


?>