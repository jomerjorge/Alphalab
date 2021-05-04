<?php

require("../../lib/core.php");
require("../../functions/param.php");

$testparam = $_POST["testparam"];
$des = $_POST["des"];

newParam($testparam, $des);

$response = array(
	"message" => "Successfully Added",
	"status" => true
);

echo json_encode($response);


?>