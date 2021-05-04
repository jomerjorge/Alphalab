<?php

require("../../lib/core.php");

	if(isset($_POST['hidden_id']))
	{
		 $tc_potable = $_POST['tc_potable'];
		 $thc_potable = $_POST['thc_potable'];
		 $hpc_result = $_POST['hpc_result'];
		 $ec_result = $_POST['ec_result'];
		 $tc_waste = $_POST['tc_waste'];
		 $fc_waste = $_POST['fc_waste'];
		 $micro_analyst = $_POST['micro_analyst'];
		 $remarks = $_POST['remarks'];
		 $micro_id = $_POST['hidden_id'];

		 for($count = 0; $count < count($micro_id); $count++)
		 {
			  $data = array(
				   ':tc_potable'   => $tc_potable[$count],
				   ':thc_potable'  => $thc_potable[$count],
				   ':hpc_result'  => $hpc_result[$count],
				   ':ec_result' => $ec_result[$count],
				   ':tc_waste'   => $tc_waste[$count],
				   ':fc_waste'  => $fc_waste[$count],
				   ':micro_analyst'   => $micro_analyst[$count],
				   ':remarks'   => $remarks[$count],
				   ':micro_id'   => $micro_id[$count]
		  );
			  $query = "
				  UPDATE micro_table 
				  SET tc_potable=:tc_potable, thc_potable=:thc_potable, hpc_result=:hpc_result, 
			  		  ec_result=:ec_result, tc_waste=:tc_waste, fc_waste=:fc_waste, 
			  		  micro_analyst=:micro_analyst, remarks=:remarks
				  WHERE micro_id = :micro_id
				  ";

        	  $db = getConnection();
			  $statement = $db->prepare($query);
			  $statement->execute($data);
		 }
	}



?>