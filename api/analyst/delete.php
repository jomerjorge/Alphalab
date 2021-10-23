<?php

require("../../lib/core.php");
require("../../functions/analyst.php");

$analyst_id = $_POST["analyst_id"];
del_analyst($analyst_id);

$response = array(
	"message" => "Your file has been deleted.",
	"status" => true
);

echo json_encode($response);

?>