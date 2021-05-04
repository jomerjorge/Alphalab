<?php

require("../../lib/core.php");

	if(isset($_POST['hidden_id']))
	{
		 $tc_waste = $_POST['tc_waste'];
		 $fc_waste = $_POST['fc_waste'];
		 $micro_analyst = $_POST['micro_analyst_mw'];
		 $remarks = $_POST['remarks_mw'];
		 $mc_date_enc = $_POST["mc_date_enc"];
		 $mc_date_prnt = $_POST["mc_date_prnt"];
		 $micro_id = $_POST['hidden_id'];

		 for($count = 0; $count < count($micro_id); $count++)
		 {
			  $data = array(
				   ':tc_waste'   => $tc_waste[$count],
				   ':fc_waste'  => $fc_waste[$count],
				   ':micro_analyst_mw'   => $micro_analyst[$count],
				   ':remarks_mw'   => $remarks[$count],
				   ':mc_date_enc'   => $mc_date_enc[$count],
				   ':mc_date_prnt'   => $mc_date_prnt[$count],
				   ':micro_id'   => $micro_id[$count]
		  );
			  $query = "
				  UPDATE micro_table 
				  SET tc_waste=:tc_waste, fc_waste=:fc_waste, micro_analyst=:micro_analyst_mw, 
				  	  remarks=:remarks_mw, mc_date_enc=:mc_date_enc, mc_date_prnt=:mc_date_prnt
				  WHERE micro_id=:micro_id
				  ";

        	  $db = getConnection();
			  $statement = $db->prepare($query);
			  $statement->execute($data);
		 }
	}



?>