<?php

require("../../lib/core.php");
require("../../functions/fsa.php");

$request = getFsa();
echo json_encode($request);

?>