<?php 

require("../../lib/core.php");
require("../../functions/user_account.php");

$user_username = $_POST["user_username"];
$user_password = $_POST["user_password"];
$user_usertype = $_POST["user_usertype"];

new_useraccount($user_username, $user_password, $user_usertype);

$response = array(
	"message" => "New account has been successfully created.",
	"status" => true
);

echo json_encode($response);


?> 