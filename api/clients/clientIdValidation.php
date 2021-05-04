<?php  
require("../../lib/core.php");
require("../../functions/clients.php");

$id_num = $_POST["id_num"];
$checkId = checkId($id_num);

    if(!empty($id_num) AND strlen($id_num) == 9) {
    
            if($checkId > 0){
                    echo "<span class='glyphicon glyphicon-remove-sign' id='status-not-available' > ID Number already Exist!</span><script>document.getElementById('clientIdSaveBtn').disabled = true;</script>";
                     	return false;
            } 
            else
            {
                 echo "<span class='glyphicon glyphicon-ok-sign' id='status-available' > ID Number Available.</span><script>document.getElementById('clientIdSaveBtn').disabled = false;</script>";
               		 return false;
                } 
    } else {
            echo "<span class='glyphicon glyphicon-remove-sign' id='status-not-available' > Invalid ID Number!</span><script>document.getElementById('clientIdSaveBtn').disabled = true;</script>";
                return false;
    }


?>