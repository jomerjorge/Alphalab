<?php

require("../../lib/core.php");
require("../../functions/testreq.php");

$state = $_POST["state"];
$client_id = $_POST["client_id"];
$date_com_pw = $_POST["date_com_pw"];
$date_prnt_pw = $_POST["date_prnt_pw"];
$req_id = $_POST["req_id"];

updateStatus($state, $date_com_pw, $date_prnt_pw, $client_id, $req_id);

$response = array(
    "message" => "Successfully Updated!",
    "status" => true
);

echo json_encode($response);



?>