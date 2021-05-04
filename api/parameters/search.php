<?php 

require("../../lib/core.php");
require("../../functions/param.php");

$description = isset($_GET["description"]) ? $_GET["description"] : "";
$param = searchParam($description);
echo json_encode($param);

?>