<?php
require("../../lib/core.php");
require("../../functions/checkLogState.php");
require("../../functions/login_functions.php");

checkLogState();
        
$search_fsa = isset($_GET["search_fsa"]) ? $_GET["search_fsa"] : "";
$search_bstyle = isset($_GET["search_bstyle"]) ? $_GET["search_bstyle"] : "";
$search_add = isset($_GET["search_add"]) ? $_GET["search_add"] : "";

$From = isset($_GET["From"]) ? $_GET["From"] : "";
$to = isset($_GET["to"]) ? $_GET["to"] : "";

$date_start = date('Y-m-d', strtotime($From));
$date_end = date('Y-m-d', strtotime($to));


$query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, 
                 clients_table.client_name,
          CONCAT(clients_table.add_st, ', ', clients_table.add_city, ', ', clients_table.add_prov),
                 clients_table.contact, clients_table.email_add, clients_table.c_remarks, testreqtable.remarks,
                 testreqtable.micro_count, testreqtable.pchem_count, testreqtable.waste_count, 
                 clients_table.business_style, testreqtable.fsa, clients_table.id_num
                 FROM testreqtable 
                 INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
                 WHERE testreqtable.fsa LIKE :search_fsa AND
                           (clients_table.add_city LIKE :search_add OR
                            clients_table.add_prov LIKE :search_add OR
                            clients_table.id_num LIKE :search_add OR
                            clients_table.company_name LIKE :search_add) AND
                            clients_table.business_style LIKE :search_bstyle
                 AND date_rcvd BETWEEN :date_start AND :date_end
                 ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

        $db = getConnection();
        $search_fsa = "%".$search_fsa."%";
        $search_bstyle = "%".$search_bstyle."%";
        $search_add = "%".$search_add."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_fsa", $search_fsa);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("search_add", $search_add);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();

$columnHeader ='';
$columnHeader =      "Date Received".
                "\t"."Rwt/Rwwt No.".
                "\t"."Company Name".
                "\t"."Client Name".
                "\t"."Address".
                "\t"."Contact".
                "\t"."Email".
                "\t"."Source".
                "\t"."Remarks".
                "\t"."Micro".
                "\t"."Pchem".
                "\t"."Waste".
                "\t"."B.Style".
                "\t"."FSA".
                "\t";

//for Yearly Summary
// $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, 
//                  clients_table.client_name,
//           CONCAT(clients_table.add_st, ', ', clients_table.add_city, ', ', clients_table.add_prov),
//                  clients_table.contact, clients_table.c_remarks, testreqtable.remarks, testreqtable.micro_count,
//                  testreqtable.pchem_count, testreqtable.waste_count, clients_table.business_style,
//                  micro_table.sam_param, clients_table.id_num
//                  FROM ((micro_table 
//                  INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id)
//                  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
//                  WHERE testreqtable.fsa LIKE :search_fsa AND
//                            (clients_table.add_city LIKE :search_add OR
//                             clients_table.add_prov LIKE :search_add) AND
//                             clients_table.business_style LIKE :search_bstyle
//                  AND date_rcvd BETWEEN :date_start AND :date_end
//                  ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

//         $db = getConnection();
//         $search_fsa = "%".$search_fsa."%";
//         $search_bstyle = "%".$search_bstyle."%";
//         $search_add = "%".$search_add."%";
//         $statement = $db->prepare($query);
//         $statement->bindParam("search_fsa", $search_fsa);
//         $statement->bindParam("search_bstyle", $search_bstyle);
//         $statement->bindParam("search_add", $search_add);
//         $statement->bindParam("date_start", $date_start);
//         $statement->bindParam("date_end", $date_end);
//         $statement->execute();

// $columnHeader ='';
// $columnHeader =      "Date Received".
//                 "\t"."Rwt/Rwwt No.".
//                 "\t"."Company Name".
//                 "\t"."Client Name".
//                 "\t"."Address".
//                 "\t"."Contact".
//                 "\t"."Source".
//                 "\t"."Remarks".
//                 "\t"."Micro".
//                 "\t"."Pchem".
//                 "\t"."Waste".
//                 "\t"."B.Style".
//                 "\t"."Micro Param".
//                 "\t"."ID Number".
//                 "\t";



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