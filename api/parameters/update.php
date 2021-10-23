<?php

require("../../lib/core.php");
require("../../functions/param.php");

$testparam = $_POST["testparam"];
$test_met = $_POST["test_met"];
$param_id = $_POST["param_id"];

updateParam($testparam, $test_met, $param_id);

$response = array(
    "message" => "Successfully Updated!",
    "status" => true
);

echo json_encode($response);



?>