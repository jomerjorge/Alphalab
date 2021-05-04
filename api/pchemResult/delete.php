<?php

require("../../lib/core.php");

	if(isset($_POST["hidden_pchem"]))
	{
	 for($count = 0; $count < count($_POST["hidden_pchem"]); $count++)
	 {
	  $query = "DELETE FROM pw_table WHERE pw_id = '".$_POST['hidden_pchem'][$count]."'";
	  $db = getConnection();
	  $statement = $db->prepare($query);
	  $statement->execute();
	 }
	}

?>