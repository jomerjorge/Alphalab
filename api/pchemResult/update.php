<?php

require("../../lib/core.php");

	if(isset($_POST['hidden_pchem']))
	{
		 $sample_labelpw = $_POST['sample_labelp'];
		 $water_despw = $_POST['water_desp'];
		 $sam_pointp = $_POST['sam_pointp'];
		 $req_id = $_POST['req_id'];
		 $pw_id = $_POST['hidden_pchem'];

		 for($count = 0; $count < count($pw_id); $count++)
		 {
			  $data = array(
				   ':sample_labelpw'   => $sample_labelpw[$count],
				   ':water_despw'  => $water_despw[$count],
				   ':sam_pointp'  => $sam_pointp[$count],
				   ':req_id' => $req_id[$count],
				   ':pw_id'   => $pw_id[$count]
		  );
			  $query = "
				  UPDATE pw_table 
				  SET sample_labelpw = :sample_labelpw, water_despw = :water_despw,
			  		  sam_pointp = :sam_pointp, req_id = :req_id
				  WHERE pw_id = :pw_id
				  ORDER BY pw_id";

        	  $db = getConnection();
			  $statement = $db->prepare($query);
			  $statement->execute($data);
		 }

	}
// 	}




// require("../../lib/core.php");
// require("../../functions/pchemresult.php");

// $sample_labelpw = $_POST["sample_labelpw"];
// $water_despw = $_POST["water_despw"];
// $sam_pointp = $_POST["sam_pointp"];
// $req_id = $_POST["req_id"];
// $pw_id = $_POST["pw_id"];

// foreach ($param_idr as $param_id)
// {
	// updatePchem($sample_labelpw, $water_despw, $sam_pointp, $req_id, $pw_id);
// }

// $response = array(
//     "message" => "Successfully Updated!",
//     "status" => true
// );

// echo json_encode($response);



?>