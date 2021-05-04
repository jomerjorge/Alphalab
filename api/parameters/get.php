<?php

require("../../lib/core.php");
require("../../functions/param.php");

$param_id = $_GET["param_id"];
$param = getParamByID($param_id);
echo json_encode($param);


?>