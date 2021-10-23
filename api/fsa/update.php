<?php

require("../../lib/core.php");
require("../../functions/fsa.php");


$fsa_name = $_POST["fsa_name"];
$fsa_status = $_POST["fsa_status"];
$id = $_POST["id"];

update_fsa($fsa_name, $fsa_status, $id);

$response = array(
    "message" => "Account has been successfully updated!",
    "status" => true
);

echo json_encode($response);


?> 