<?php 

function getPWRes($search, $date_start, $date_end){
    
    // $query =  "SELECT *
    //            FROM testreqtable 
    //            WHERE test_cat NOT LIKE 'MICRO' AND 
    //                  test_cat NOT LIKE 'COLIFORM(Waste)' AND
    //                      (rwt_num LIKE :search OR fsa LIKE :search) AND
    //                      date_rcvd BETWEEN :date_start AND :date_end
    //             ORDER BY rwt_num DESC";


    $query =  "SELECT clients_table.company_name, clients_table.add_city, clients_table.add_prov,   
               testreqtable.date_rcvd, testreqtable.rwt_num, testreqtable.fsa, testreqtable.state,
               testreqtable.req_id, testreqtable.client_id, testreqtable.date_com_pw,
               testreqtable.date_prnt_pw, clients_table.client_name
               FROM testreqtable 
               INNER JOIN clients_table ON testreqtable.client_id = clients_table.id 
               WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                     testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND
                         (testreqtable.rwt_num LIKE :search OR testreqtable.fsa LIKE :search) AND
                         testreqtable.date_rcvd BETWEEN :date_start AND :date_end
                ORDER BY testreqtable.rwt_num ASC";

  
    try{
        $db = getConnection();
        $search = "%".$search."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }

}

	
function dataFound($search, $date_start, $date_end) {

        // $query =  "SELECT *
        //        FROM testreqtable 
        //        WHERE test_cat NOT LIKE 'MICRO' AND 
        //              test_cat NOT LIKE 'COLIFORM(Waste)' AND
        //                  (rwt_num LIKE :search OR fsa LIKE :search) AND
        //                  date_rcvd BETWEEN :date_start AND :date_end
        //         ORDER BY rwt_num DESC";


     $query =  "SELECT clients_table.company_name, clients_table.add_city, clients_table.add_prov,   
               testreqtable.date_rcvd, testreqtable.rwt_num, testreqtable.fsa, testreqtable.state,
               testreqtable.req_id, testreqtable.client_id, testreqtable.date_com_pw,
               testreqtable.date_prnt_pw, clients_table.client_name
               FROM testreqtable 
               INNER JOIN clients_table ON testreqtable.client_id = clients_table.id 
               WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                     testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND
                         (testreqtable.rwt_num LIKE :search OR testreqtable.fsa LIKE :search) AND
                         testreqtable.date_rcvd BETWEEN :date_start AND :date_end
                ORDER BY testreqtable.rwt_num ASC";

    try{
        $db         = getConnection();
        $search = "%".$search."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}


 ?>