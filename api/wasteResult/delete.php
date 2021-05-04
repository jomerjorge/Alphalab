<?php

require("../../lib/core.php");

	if(isset($_POST["hidden_waste"]))
	{
	 for($count = 0; $count < count($_POST["hidden_waste"]); $count++)
	 {
	  $query = "DELETE FROM pw_table WHERE pw_id = '".$_POST['hidden_waste'][$count]."'";
	  $db = getConnection();
	  $statement = $db->prepare($query);
	  $statement->execute();
	 }
	}


?>