<?php

require("../../lib/core.php");
require("../../functions/param.php");

$param = getParam();
echo json_encode($param);



?>