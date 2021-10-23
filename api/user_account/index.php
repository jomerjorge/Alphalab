<?php 

require("../../lib/core.php");
require("../../functions/user_account.php");

$user_account = view_useraccount();
echo json_encode($user_account);

?>