<?php

function getSummary()
{
    $query = "SELECT clients_table.company_name, testreqtable.date_rcvd, clients_table.client_name,
                     -- GROUP_CONCAT(testreqtable.micro_count, ' ') as micro_count
                     -- MAX(testreqtable.micro_count) as micro_count
                     -- sum(testreqtable.micro_count) micro_count
                     testreqtable.micro_count
                     FROM testreqtable 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
                     WHERE clients_table.business_style LIKE 'WRS'";       
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        // $statement->bindParam("client_id", $client_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


?>