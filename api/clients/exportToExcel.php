<?php
require("../../lib/core.php");
require("../../functions/checkLogState.php");
require("../../functions/login_functions.php");

checkLogState();
        
$search = isset($_GET["search"]) ? $_GET["search"] : "";

$query = "SELECT `id_num`,`company_name`,`client_name` ,`add_st` ,`add_city` ,`add_prov` ,`contact` ,`business_style`, `ass_fsa`, `c_status` FROM clients_table WHERE company_name LIKE CONCAT('%' , :search , '%') || 
                                                add_prov LIKE CONCAT('%' , :search , '%')";
$db = getConnection();
$stmt=$db->prepare($query);
$stmt->bindParam("search", $search);
$stmt->execute();

$columnHeader ='';
$columnHeader = "Id No."."\t"."Company Name"."\t"."Client Name"."\t"."Address"."\t"."City"."\t"."Province"."\t"."Contact No."."\t"."Business Style"."\t"."Assigned FSA"."\t"."Status"."\t";

$setData='';

while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
{
  $rowData = '';
  foreach($rec as $value)
  {
    $value = '"' . $value . '"' . "\t";
    $rowData .= $value;
  }
  $setData .= trim($rowData)."\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Company record sheet.xls");
header("Pragma: no-cache");
header("Expires: 0");



echo ucwords($columnHeader)."\n".$setData."\n";




  ?>