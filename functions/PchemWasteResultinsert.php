<?php 

function getPchemWaste($req_id)
{
    $query = "SELECT clients_table.company_name, testreqtable.rwt_num, testreqtable.date_rcvd, 
                     pw_table.sample_labelpw, pw_table.water_despw, pw_table.sam_pointp,
                     pw_table.pw_param, pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst,
                     testreqtable.fsa, pw_table.pw_id, testreqtable.req_id, pw_table.pw_date_enc
                     FROM ((pw_table 
                     INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id)
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE testreqtable.req_id = :req_id";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("req_id", $req_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


function searchBySource($description, $req_id)
{

    $query = "  SELECT * 
                FROM ((pw_table 
                INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id)
                INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                WHERE (pw_table.pw_param LIKE :description OR
                       pw_table.sample_labelpw LIKE :description OR
                       pw_table.water_despw LIKE :description OR
                       pw_table.sam_pointp LIKE :description) AND 
                       pw_table.req_id = :req_id";

    try{
        $db         = getConnection();
        $description = "%".$description."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("description", $description);
        $statement->bindParam("req_id", $req_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" searchClients:' . $e->getMessage() . '}}';
    }
}


function pwsingleview($req_id)
{
    $query = "SELECT sample_labelpw, water_despw, sam_pointp, COUNT(testreqtable.req_id)
              FROM ((pw_table
              INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id)
              INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
              WHERE testreqtable.req_id = :req_id
              GROUP BY sample_labelpw, water_despw, sam_pointp
              HAVING  COUNT(testreqtable.req_id) > 1";

    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("req_id", $req_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


?>