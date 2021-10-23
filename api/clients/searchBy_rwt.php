<?php 
 
require("../../lib/core.php");
require("../../functions/clients.php");

$description = isset($_GET["description"]) ? $_GET["description"] : "";
$data = searchBy_rwt($description);

echo json_encode($data);

?>