<?php

require("../../lib/core.php");
require("../../functions/PchemWasteResultinsert.php");

$req_id = $_GET["req_id"];
$description = isset($_GET["description"]) ? $_GET["description"] : "";

$request = searchBySource($description, $req_id);
echo json_encode($request);





?>