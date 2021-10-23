<?php  
// for exporting data
function checkLogState(){

   $db = getConnection();
   if (!func::checkLoginState($db))
    {   
    echo "Please Log In First!";
    echo "<script>setTimeout(\"location.href = '/alphalab/login.php';\",1500);</script>";
    exit();
        
    }

}
?>