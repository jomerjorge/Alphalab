<?php 

function view_hold(){

    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, micro_table.sam_param, 
                     micro_table.sample_label, micro_table.sam_point,micro_table.tc_potable,
                     micro_table.thc_potable, micro_table.hpc_result, micro_table.ec_result, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND 
                           testreqtable.test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND
                           testreqtable.test_cat NOT LIKE 'WASTE & COLIFORM' AND
                           micro_table.remarks = 'Hold'
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC";

    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }

}


function getMicroRes($search, $date_start, $date_end){
   
    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, micro_table.sam_param,
                     micro_table.sample_label, micro_table.sam_point, micro_table.tc_potable,
                     micro_table.thc_potable, micro_table.hpc_result, micro_table.ec_result, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks,
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt  
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND 
                           testreqtable.test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND
                           testreqtable.test_cat NOT LIKE 'WASTE & COLIFORM' AND 
                           testreqtable.fsa LIKE :search AND 
                           testreqtable.date_rcvd BETWEEN :date_start AND :date_end
                     ORDER BY testreqtable.rwt_num ASC, micro_table.micro_id ASC";

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

    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, micro_table.sam_param,
                     micro_table.sample_label, micro_table.sam_point, micro_table.tc_potable,
                     micro_table.thc_potable, micro_table.hpc_result, micro_table.ec_result,
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks,
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt  
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND 
                           testreqtable.test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND
                           testreqtable.test_cat NOT LIKE 'WASTE & COLIFORM' AND 
                           testreqtable.fsa LIKE :search AND 
                           testreqtable.date_rcvd BETWEEN :date_start AND :date_end
                     ORDER BY testreqtable.rwt_num ASC, micro_table.micro_id ASC";     


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

function getMicroRes_S($search){
   
    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, micro_table.sam_param, 
                     micro_table.sample_label, micro_table.sam_point,micro_table.tc_potable,
                     micro_table.thc_potable, micro_table.hpc_result, micro_table.ec_result, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND 
                           testreqtable.test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND
                           testreqtable.test_cat NOT LIKE 'WASTE & COLIFORM' AND 
                           (testreqtable.rwt_num LIKE :search OR micro_table.remarks LIKE :search)
                     ORDER BY testreqtable.rwt_num ASC, micro_table.micro_id ASC";

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

    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, micro_table.water_des, micro_table.sam_param, 
                     micro_table.sample_label, micro_table.sam_point,micro_table.tc_potable,
                     micro_table.thc_potable, micro_table.hpc_result, micro_table.ec_result, 
                     testreqtable.fsa, micro_table.micro_analyst, micro_table.remarks, 
                     micro_table.micro_id, micro_table.mc_date_enc, micro_table.mc_date_prnt
                     FROM micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
                     WHERE testreqtable.test_cat NOT LIKE 'COLIFORM(Waste)' AND 
                           testreqtable.test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND
                           testreqtable.test_cat NOT LIKE 'WASTE & COLIFORM' AND 
                           (testreqtable.rwt_num LIKE :search OR micro_table.remarks LIKE :search)
                     ORDER BY testreqtable.rwt_num ASC, micro_table.micro_id ASC";
      
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