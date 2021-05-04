<?php

require("../../lib/core.php");
require("../../functions/testreq.php");

$req_id = $_POST["req_id"];
removeReq($req_id);

$response = array(
	"message" => "Deleted Successfully",
	"status" => true
);

echo json_encode($response);


?>