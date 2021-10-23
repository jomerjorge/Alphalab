<?php
require("../../lib/core.php");
require("../../functions/checkLogState.php");
require("../../functions/login_functions.php");

checkLogState();
        
$search_com_ml = isset($_GET["search_com_ml"]) ? $_GET["search_com_ml"] : "";
$search_add_ml = isset($_GET["search_add_ml"]) ? $_GET["search_add_ml"] : "";
$search_bstyle = isset($_GET["search_bstyle"]) ? $_GET["search_bstyle"] : "";
$search_afsa = isset($_GET["search_afsa"]) ? $_GET["search_afsa"] : "";

$query = "SELECT clients_table.id_num, clients_table.company_name, clients_table.client_name, 
                 CONCAT(clients_table.add_st, ', ', clients_table.add_city, ', ', clients_table.add_prov),
                 clients_table.contact, clients_table.email_add, clients_table.business_style,
                 clients_table.c_remarks, clients_table.ass_fsa, testreqtable.fsa,
                 testreqtable.rwt_num, testreqtable.date_rcvd, clients_table.c_status
                 FROM (SELECT client_id, MAX(date_rcvd) as date_rcvd, 
                                         COUNT(fsa) as fsa, 
                                         MAX(rwt_num) as rwt_num
                 FROM testreqtable
                 GROUP BY client_id) AS testreqtable
                 INNER JOIN clients_table ON clients_table.id = testreqtable.client_id
                 WHERE clients_table.company_name LIKE :search_com_ml
                 AND (clients_table.add_st LIKE :search_add_ml OR 
                      clients_table.add_city LIKE :search_add_ml OR
                      clients_table.add_prov LIKE :search_add_ml OR
                      clients_table.c_status LIKE :search_add_ml OR
                      clients_table.id_num LIKE :search_add_ml)
                 AND clients_table.business_style LIKE :search_bstyle
                 AND clients_table.ass_fsa LIKE :search_afsa
                 ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

        $db = getConnection();
        $search_com_ml = "%".$search_com_ml."%";
        $search_add_ml = "%".$search_add_ml."%";
        $search_bstyle = "%".$search_bstyle."%";
        $search_afsa = "%".$search_afsa."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_com_ml", $search_com_ml);
        $statement->bindParam("search_add_ml", $search_add_ml);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("search_afsa", $search_afsa);
        $statement->execute();


$columnHeader ='';
$columnHeader =      "ID No.".
                "\t"."Company Name".
                "\t"."Client Name".
                "\t"."Complete Address".
                "\t"."Contact".
                "\t"."Email".
                "\t"."Business Style".
                "\t"."Remarks".
                "\t"."FSA".
                "\t"."Total Number of Test".
                "\t"."Last RWT/RWWT Number".
                "\t"."Last Date of Sample".
                "\t"."Status".
                "\t";

$setData='';

while($rec =$statement->FETCH(PDO::FETCH_ASSOC))
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