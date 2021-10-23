<?php 
require("lib/core.php");
require("functions/login_functions.php");

// $db = getConnection();
// func::userlog_insert_out($db);

func::deleteCookie();

header('location:login.php');
?>