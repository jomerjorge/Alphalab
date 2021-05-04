<?php 

function pw_view(){

    $query = "SELECT clients_table.company_name, clients_table.add_city, clients_table.add_prov,
                     testreqtable.date_rcvd, testreqtable.rwt_num, testreqtable.fsa, 
                     testreqtable.state, testreqtable.req_id, testreqtable.client_id,
                     testreqtable.date_com_pw, testreqtable.date_prnt_pw, testreqtable.test_cat,
                     clients_table.client_name
              FROM testreqtable 
              INNER JOIN clients_table ON testreqtable.client_id = clients_table.id 
              WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                    testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND
                    testreqtable.state NOT LIKE 'Printed' AND
                    testreqtable.state NOT LIKE 'Completed'
              ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


// -------------------------------- to add

function searchRWT($search_rwt){

    $query = "SELECT clients_table.company_name, clients_table.add_city, clients_table.add_prov,
                     testreqtable.date_rcvd, testreqtable.rwt_num, testreqtable.fsa, testreqtable.state,
                     testreqtable.req_id, testreqtable.client_id, testreqtable.date_com_pw,
                     testreqtable.date_prnt_pw, testreqtable.test_cat, clients_table.client_name
              FROM testreqtable
              INNER JOIN clients_table ON testreqtable.client_id = clients_table.id 
              WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                   testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND
                  (testreqtable.rwt_num LIKE :search_rwt OR testreqtable.state LIKE :search_rwt)
              ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

    try{
        $db = getConnection();
        $search_rwt = "%".$search_rwt."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_rwt", $search_rwt);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


function dataFound($search_rwt) {
    
    $query = "SELECT clients_table.company_name, clients_table.add_city, clients_table.add_prov,
                     testreqtable.date_rcvd, testreqtable.rwt_num, testreqtable.fsa, testreqtable.state,
                     testreqtable.req_id, testreqtable.client_id, testreqtable.date_com_pw,
                     testreqtable.date_prnt_pw, testreqtable.test_cat, clients_table.client_name
              FROM testreqtable
              INNER JOIN clients_table ON testreqtable.client_id = clients_table.id 
              WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                    testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND
                   (testreqtable.rwt_num LIKE :search_rwt OR testreqtable.state LIKE :search_rwt)
              ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

    try{
        $db         = getConnection();
        $search_rwt = "%".$search_rwt."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search_rwt", $search_rwt);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}


?>