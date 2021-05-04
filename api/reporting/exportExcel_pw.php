<?php
require("../../lib/core.php");
require("../../functions/checkLogState.php");
require("../../functions/login_functions.php");

checkLogState();
        
$search_by_param = isset($_GET["search_by_param"]) ? $_GET["search_by_param"] : "";
$search_by_company_name = isset($_GET["search_by_company_name"]) ? $_GET["search_by_company_name"] : "";
$search_by_address = isset($_GET["search_by_address"]) ? $_GET["search_by_address"] : "";
$chemAnalyst_ddlist = isset($_GET["chemAnalyst_ddlist"]) ? $_GET["chemAnalyst_ddlist"] : "";
$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));

$query = "SELECT pw_table.pw_param, pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst, 
                     pw_table.water_despw, pw_table.sample_labelpw, testreqtable.date_rcvd,
                     testreqtable.rwt_num, clients_table.company_name, clients_table.client_name,
                     clients_table.add_city, clients_table.add_prov, pw_table.pw_date_enc,
                     testreqtable.date_com_pw, testreqtable.date_prnt_pw
                     FROM ((pw_table 
                     INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id) 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE  pw_table.pw_param LIKE :search_by_param AND 
                           (clients_table.add_city LIKE :search_by_address OR
                            clients_table.add_prov LIKE :search_by_address) AND
                           (clients_table.company_name LIKE :search_by_company_name OR
                            clients_table.client_name LIKE :search_by_company_name) AND
                            pw_table.pw_analyst LIKE :chemAnalyst_ddlist
                     AND (testreqtable.state LIKE 'Completed' OR testreqtable.state LIKE 'Printed')
                     AND date_rcvd BETWEEN :date_start AND :date_end 
                     ORDER BY testreqtable.date_rcvd";

    $db = getConnection();
        $search_by_param = "%".$search_by_param."%";
        $search_by_company_name = "%".$search_by_company_name."%";
        $search_by_address = "%".$search_by_address."%";
        $chemAnalyst_ddlist = "%".$chemAnalyst_ddlist."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_by_param", $search_by_param);
        $statement->bindParam("search_by_company_name", $search_by_company_name);
        $statement->bindParam("search_by_address", $search_by_address);
        $statement->bindParam("chemAnalyst_ddlist", $chemAnalyst_ddlist);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();

$columnHeader ='';
$columnHeader =      "Analysis".
                "\t"."Method".
                "\t"."Result".
                "\t"."Analyst".
                "\t"."Water Desc.".
                "\t"."Sample Label".
                "\t"."Date Received".
                "\t"."Rwt/Rwwt No.".
                "\t"."Company Name".
                "\t"."Client Name".
                "\t"."City".
                "\t"."Province".
                "\t"."Date Encoded".
                "\t"."Date Completed".
                "\t"."Date Printed".
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