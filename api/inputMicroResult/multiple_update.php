<?php

require("../../lib/core.php");

	if(isset($_POST['hidden_id']))
	{
		 $tc_potable = $_POST['tc_potable'];
		 $thc_potable = $_POST['thc_potable'];
		 $hpc_result = $_POST['hpc_result'];
		 $ec_result = $_POST['ec_result'];
		 $micro_analyst = $_POST['micro_analyst'];
		 $remarks = $_POST['remarks'];
		 $mc_date_enc = $_POST["mc_date_enc"];
		 $mc_date_prnt = $_POST["mc_date_prnt"];
		 $micro_id = $_POST['hidden_id'];

		 for($count = 0; $count < count($micro_id); $count++)
		 {
			  $data = array(
				   ':tc_potable'   => $tc_potable[$count],
				   ':thc_potable'  => $thc_potable[$count],
				   ':hpc_result'  => $hpc_result[$count],
				   ':ec_result' => $ec_result[$count],
				   ':micro_analyst'   => $micro_analyst[$count],
				   ':remarks'   => $remarks[$count],
				   ':mc_date_enc'   => $mc_date_enc[$count],
				   ':mc_date_prnt'   => $mc_date_prnt[$count],
				   ':micro_id'   => $micro_id[$count]
		  );
			  $query = "
				  UPDATE micro_table 
				  SET tc_potable=:tc_potable, thc_potable=:thc_potable, hpc_result=:hpc_result, 
			  		  ec_result=:ec_result, micro_analyst=:micro_analyst, remarks=:remarks,
			  		  mc_date_enc=:mc_date_enc, mc_date_prnt=:mc_date_prnt
				  WHERE micro_id=:micro_id
				  ORDER BY micro_id";

        	  $db = getConnection();
			  $statement = $db->prepare($query);
			  $statement->execute($data);
		 }
	}



?>