<?php 

require("../../lib/core.php");
require("../../functions/testreq.php");

$test_cat = $_POST["test_cat"];
$rwt_num = $_POST["rwt_num"];
$chkrwt = chkrwt($rwt_num);

if ($test_cat == "MICRO" || $test_cat == "MICRO & PCHEM" || $test_cat == "PCHEM") 
    {
                if(strlen($rwt_num) < 6){
                         echo "<span class='glyphicon glyphicon-remove' id='status-not-available' > Invalid Input!</span><script>document.getElementById('rwtSaveBtn').disabled = true;</script>";
                         // echo "<input type='text' class='form-control input-sm' id='rwt_num'>
                         //            <span class='glyphicon glyphicon-remove form-control-feedback'></span>
                         //            <script>document.getElementById('rwtSaveBtn').disabled = true;</script>";
                         return false;
                }

    } else {
                if(strlen($rwt_num) < 4){
                         echo "<span class='glyphicon glyphicon-remove-sign' id='status-not-available' > Invalid Input!</span><script>document.getElementById('rwtSaveBtn').disabled = true;</script>";
                         // echo "<input type='text' class='form-control input-sm' id='rwt_num'>
                         //            <span class='glyphicon glyphicon-remove form-control-feedback'></span>
                         //            <script>document.getElementById('rwtSaveBtn').disabled = true;</script>";
                         return false;
                }

    }


    if(!empty($rwt_num)) {
    
            if($chkrwt > 0){
                    echo "<span class='glyphicon glyphicon-remove-sign' id='status-not-available' > RWT Number already Exist!</span><script>document.getElementById('rwtSaveBtn').disabled = true;</script>";
                         // echo "<input type='text' class='form-control input-sm' id='rwt_num'>
                         //            <span class='glyphicon glyphicon-remove form-control-feedback'></span>
                         //            <script>document.getElementById('rwtSaveBtn').disabled = true;</script>";
            } 
            else
            {
                 echo "<span class='glyphicon glyphicon-ok-sign' id='status-available' > RWT Number Available.</span><script>document.getElementById('rwtSaveBtn').disabled = false;</script>";
                         // echo "<input type='text' class='form-control input-sm' id='rwt_num'>
                         //            <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                         //            <script>document.getElementById('rwtSaveBtn').disabled = false;</script>";
               
                } 
    }
   

?>