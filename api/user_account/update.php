<?php

require("../../lib/core.php");
require("../../functions/user_account.php");


$user_username = $_POST["user_username"];
$user_password = $_POST["user_password"];
$user_usertype = $_POST["user_usertype"];
$id = $_POST["id"];

update_useraccount($user_username, $user_password, $user_usertype, $id);

$response = array(
    "message" => "Account has been successfully updated!",
    "status" => true
);

echo json_encode($response);



?> 