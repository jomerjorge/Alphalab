<?php  
require("../../lib/core.php");
require("../../functions/login_functions.php");

   $db = getConnection();
   if (!func::checkLoginState($db))
    {   
    	echo '1';     //session expired  
    	exit();
    }
    else{
    	echo '0';     //session not expired
    }

?>