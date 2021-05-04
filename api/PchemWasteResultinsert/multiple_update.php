<?php

require("../../lib/core.php");

	if(isset($_POST['hidden_id']))
	{
		$pw_met = $_POST["pw_met"];
		$pw_result = $_POST["pw_result"];
		$pw_analyst = $_POST["pw_analyst"];
		$req_id = $_POST["req_id"];
		$pw_id = $_POST["hidden_id"];

		 for($count = 0; $count < count($pw_id); $count++)
		 {
			  $data = array(
				   ':pw_met'   => $pw_met[$count],
				   ':pw_result'   => $pw_result[$count],
				   ':pw_analyst'  => $pw_analyst[$count],
				   ':req_id'  => $req_id[$count],
				   ':pw_id'   => $pw_id[$count]
		  		);
			  $query = "
				  UPDATE pw_table 
				  SET pw_met=:pw_met, pw_result=:pw_result, pw_analyst=:pw_analyst, pw_date_enc=NOW(), req_id=:req_id
				  WHERE pw_id = :pw_id
				  ";

        	  $db = getConnection();
			  $statement = $db->prepare($query);
			  $statement->execute($data);
		 }
	}

?>