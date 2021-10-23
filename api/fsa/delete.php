<?php

require("../../lib/core.php");
require("../../functions/fsa.php");

$fsa_id = $_POST["fsa_id"];
del_fsa($fsa_id);

$response = array(
	"message" => "Your file has been deleted.",
	"status" => true
);

echo json_encode($response);

?>