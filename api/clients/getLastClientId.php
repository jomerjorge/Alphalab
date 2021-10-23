<?php

require("../../lib/core.php");
require("../../functions/clients.php");

$lastId = getLastClientId();
echo json_encode($lastId);

?>