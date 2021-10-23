<?php 

function getMicroWasteRes($search, $date_start, $date_end){
   
    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, 
                     micro_table.sample_label, micro_table.tc_waste, micro_table.fc_waste, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt 
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO with Special Test' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO & PCHEM' AND  
                           testreqtable.test_cat NOT LIKE 'POOL' AND 
                           testreqtable.fsa LIKE :search AND 
                           testreqtable.date_rcvd BETWEEN :date_start AND :date_end
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

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

    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, 
                     micro_table.sample_label, micro_table.tc_waste, micro_table.fc_waste, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt 
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO with Special Test' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO & PCHEM' AND 
                           testreqtable.test_cat NOT LIKE 'POOL' AND 
                           testreqtable.fsa LIKE :search AND 
                           testreqtable.date_rcvd BETWEEN :date_start AND :date_end";     


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


//  single search

function getMicroWasteRes_S($search){
   
    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, 
                     micro_table.sample_label, micro_table.tc_waste, micro_table.fc_waste, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO with Special Test' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO & PCHEM' AND 
                           testreqtable.test_cat NOT LIKE 'POOL' AND 
                           (testreqtable.rwt_num LIKE :search OR micro_table.remarks LIKE :search)
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

    try{
        $db = getConnection();
        $search = "%".$search."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }

}

function dataFound_s($search) {

    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, 
                     micro_table.sample_label, micro_table.tc_waste, micro_table.fc_waste, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO with Special Test' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO & PCHEM' AND 
                           testreqtable.test_cat NOT LIKE 'POOL' AND 
                           (testreqtable.rwt_num LIKE :search OR micro_table.remarks LIKE :search)";
      
    try{
        $db         = getConnection();
        $search = "%".$search."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}


 ?>