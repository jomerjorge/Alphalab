<?php

require("../../../lib/core.php");
require("../../../functions/dataGraph.php");

$request = num_clients();
echo json_encode($request);


?>