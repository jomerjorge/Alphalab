<?php
require("../../lib/core.php");
require("../../functions/checkLogState.php");
require("../../functions/login_functions.php");

checkLogState();
        
$search_comp = isset($_GET["search_comp"]) ? $_GET["search_comp"] : "";
$search_add = isset($_GET["search_add"]) ? $_GET["search_add"] : "";
$search_analyst_mc = isset($_GET["search_analyst_mc"]) ? $_GET["search_analyst_mc"] : "";
$search_fsa = isset($_GET["search_fsa"]) ? $_GET["search_fsa"] : "";
$search_bstyle = isset($_GET["search_bstyle"]) ? $_GET["search_bstyle"] : "";

$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));

$query = "SELECT micro_table.tc_potable, micro_table.thc_potable, micro_table.hpc_result,
                     micro_table.ec_result, micro_table.tc_waste, micro_table.fc_waste, 
                     testreqtable.remarks, micro_table.water_des, micro_table.sample_label,
                     testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, clients_table.client_name,   
                     clients_table.add_city, clients_table.add_prov, testreqtable.fsa,
                     micro_table.micro_analyst, micro_table.mc_date_enc, micro_table.mc_date_prnt,
                     clients_table.contact, clients_table.business_style
                     FROM ((micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id)
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE testreqtable.fsa LIKE :search_fsa AND
                           (clients_table.company_name LIKE :search_comp OR
                            clients_table.client_name LIKE :search_comp) AND
                           (clients_table.add_city LIKE :search_add OR
                            clients_table.add_prov LIKE :search_add) AND
                            clients_table.business_style LIKE :search_bstyle AND
                            micro_table.micro_analyst LIKE :search_analyst_mc
                     AND (micro_table.remarks LIKE 'Done' OR micro_table.remarks LIKE 'Printed' OR micro_table.remarks LIKE 'Hold') 
                     AND date_rcvd BETWEEN :date_start AND :date_end 
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

        $db = getConnection();
        $search_comp = "%".$search_comp."%";
        $search_add = "%".$search_add."%";
        $search_analyst_mc = "%".$search_analyst_mc."%";
        $search_fsa = "%".$search_fsa."%";
        $search_bstyle = "%".$search_bstyle."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_comp", $search_comp);
        $statement->bindParam("search_add", $search_add);
        $statement->bindParam("search_analyst_mc", $search_analyst_mc);
        $statement->bindParam("search_fsa", $search_fsa);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();

$columnHeader ='';
$columnHeader =      "TC-P".
                "\t"."ThC-P".
                "\t"."HPC".
                "\t"."EC".
                "\t"."TC-W".
                "\t"."FC-W".
                "\t"."Remarks". 
                "\t"."Water Desc.".
                "\t"."Sample Label".
                "\t"."Date Received".
                "\t"."Rwt/Rwwt No.".
                "\t"."Company Name".
                "\t"."Client Name".
                "\t"."City".
                "\t"."Province".
                "\t"."FSA".
                "\t"."Analyst".
                "\t"."Date Encoded".
                "\t"."Date Printed".
                "\t"."Contact Number".
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