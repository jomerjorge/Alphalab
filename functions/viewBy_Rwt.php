<?php 

// micro potable
function view_by_micro($search){
   
    $query = "SELECT micro_table.thc_potable, micro_table.tc_potable, micro_table.hpc_result,
                     micro_table.ec_result, micro_table.tc_waste, micro_table.fc_waste,
                     micro_table.water_des, micro_table.sample_label, micro_table.sam_point,
                     testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.id_num,
                     clients_table.company_name, clients_table.client_name, clients_table.add_st,
                     clients_table.add_city, clients_table.add_prov, micro_table.remarks, 
                     testreqtable.fsa, micro_table.sam_param, clients_table.contact, clients_table.email_add
                     FROM ((micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id)
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE testreqtable.rwt_num LIKE :search
                     ORDER BY micro_table.req_id DESC";

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

// pchem 
function view_by_pchem($search){
   
 
    $query = "SELECT pw_table.pw_param, pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst, 
                     pw_table.water_despw, pw_table.sample_labelpw, pw_table.sam_pointp,
                     testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.id_num,
                     clients_table.company_name, clients_table.client_name, clients_table.add_st,
                     clients_table.add_city, clients_table.add_prov, testreqtable.state,
                     testreqtable.fsa, testreqtable.state, clients_table.contact, clients_table.email_add
                     FROM ((pw_table 
                     INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id) 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE testreqtable.rwt_num LIKE :search
                     ORDER BY pw_table.req_id DESC";
  
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


// micro waste
function view_by_microwaste($search){
   
    $query = "SELECT micro_table.tc_waste, micro_table.fc_waste, micro_table.ec_result,
                     micro_table.water_des, micro_table.sample_label, micro_table.sam_point,
                     testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.id_num,
                     clients_table.company_name, clients_table.client_name, clients_table.add_st,
                     clients_table.add_city, clients_table.add_prov, micro_table.remarks, 
                     testreqtable.fsa, clients_table.contact, clients_table.email_add
                     FROM ((micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id)
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE testreqtable.test_cat NOT LIKE 'MICRO' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO & PCHEM' AND
                           testreqtable.test_cat NOT LIKE 'MICRO with Special Test' AND
                           testreqtable.test_cat NOT LIKE 'POOL' AND
                           testreqtable.rwt_num LIKE :search
                     ORDER BY micro_table.req_id DESC";

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


// waste 
function view_by_waste($search){
   
 
    $query = "SELECT pw_table.pw_param, pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst, 
                     pw_table.water_despw, pw_table.sample_labelpw, testreqtable.date_rcvd,
                     testreqtable.rwt_num, clients_table.id_num, clients_table.company_name,
                     clients_table.client_name, clients_table.add_st, clients_table.add_city,
                     clients_table.add_prov, testreqtable.fsa, testreqtable.state, clients_table.contact,
                     clients_table.email_add
                     FROM ((pw_table 
                     INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id) 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE testreqtable.test_cat NOT LIKE 'PCHEM' AND 
                           testreqtable.test_cat NOT LIKE 'MICRO & PCHEM' AND
                           testreqtable.test_cat NOT LIKE 'MICRO with Special Test' AND
                           testreqtable.test_cat NOT LIKE 'POOL' AND
                           testreqtable.rwt_num LIKE :search
                     ORDER BY pw_table.req_id DESC";
  
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

 ?>