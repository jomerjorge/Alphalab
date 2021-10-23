<?php

require("../../lib/core.php");
require("../../functions/user_account.php");

$id = $_POST["id"];
del_useraccount($id);

$response = array(
	"message" => "Your file has been deleted.",
	"status" => true
);

echo json_encode($response);

?>