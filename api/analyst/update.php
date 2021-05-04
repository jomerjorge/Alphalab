<?php

require("../../lib/core.php");
require("../../functions/analyst.php");


$analyst_name = $_POST["analyst_name"];
$analyst_dept = $_POST["analyst_dept"];
$analyst_status = $_POST["analyst_status"];
$id = $_POST["id"];

update_analyst($analyst_name, $analyst_dept, $analyst_status, $id);

$response = array(
    "message" => "Account has been successfully updated!",
    "status" => true
);

echo json_encode($response);


?> 