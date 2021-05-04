<?php

// PCHEMWASTE REPORTING
function getByPage_pw($search_param, $search_comp, $search_analyst, $search_address, $date_start, $date_end, $pagelimit, $offset){
   
 
    $query = "SELECT pw_table.pw_param, pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst, 
                     pw_table.water_despw, pw_table.sample_labelpw, testreqtable.date_rcvd,
                     testreqtable.rwt_num, clients_table.company_name, clients_table.client_name,
                     clients_table.add_city, clients_table.add_prov, testreqtable.state, 
                     pw_table.pw_date_enc, testreqtable.date_com_pw, testreqtable.date_prnt_pw
                     FROM ((pw_table 
                     INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id) 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE  pw_table.pw_param LIKE :search_param AND 
                           (clients_table.add_city LIKE :search_address OR
                            clients_table.add_prov LIKE :search_address) AND
                           (clients_table.company_name LIKE :search_comp OR
                            clients_table.client_name LIKE :search_comp) AND
                            pw_table.pw_analyst LIKE :search_analyst
                     AND date_rcvd BETWEEN :date_start AND :date_end 
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC
                     LIMIT $offset, $pagelimit";
  
    try{
        $db = getConnection();
        $search_param = "%".$search_param."%";
        $search_comp = "%".$search_comp."%";
        $search_address = "%".$search_address."%";
        $search_analyst = "%".$search_analyst."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_param", $search_param);
        $statement->bindParam("search_comp", $search_comp);
        $statement->bindParam("search_address", $search_address);
        $statement->bindParam("search_analyst", $search_analyst);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }

}

function countData_pw(){

    $query = "SELECT COUNT(*) FROM pw_table 
              INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id
              WHERE (testreqtable.state LIKE 'Completed' OR testreqtable.state LIKE 'Printed')";


    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}
    
function dataFound_pw($search_param, $search_comp, $search_analyst, $search_address, $date_start, $date_end) {

    $query = "SELECT pw_table.pw_param, pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst, 
                     pw_table.water_despw, pw_table.sample_labelpw, testreqtable.date_rcvd,
                     testreqtable.rwt_num, clients_table.company_name, clients_table.client_name,
                     clients_table.add_city, clients_table.add_prov, testreqtable.state, 
                     pw_table.pw_date_enc, testreqtable.date_com_pw, testreqtable.date_prnt_pw
                     FROM ((pw_table 
                     INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id) 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id)
                     WHERE  pw_table.pw_param LIKE :search_param AND 
                           (clients_table.add_city LIKE :search_address OR
                            clients_table.add_prov LIKE :search_address) AND
                           (clients_table.company_name LIKE :search_comp OR
                            clients_table.client_name LIKE :search_comp) AND
                            pw_table.pw_analyst LIKE :search_analyst
                     AND (testreqtable.state LIKE 'Completed' OR testreqtable.state LIKE 'Printed')
                     AND date_rcvd BETWEEN :date_start AND :date_end";        
 

    try{
        $db         = getConnection();
        $search_param = "%".$search_param."%";
        $search_comp = "%".$search_comp."%";
        $search_address = "%".$search_address."%";
        $search_analyst = "%".$search_analyst."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search_param", $search_param);
        $statement->bindParam("search_comp", $search_comp);
        $statement->bindParam("search_address", $search_address);
        $statement->bindParam("search_analyst", $search_analyst);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}

// MICRO REPORTING

function getByPage_mw($search_comp, $search_add, $search_analyst_mc, $search_fsa, $search_bstyle, $date_start, $date_end, $pagelimit, $offset){
   
    $query = "SELECT micro_table.sam_param, micro_table.thc_potable, micro_table.tc_potable,
                     micro_table.hpc_result,
                     micro_table.ec_result, micro_table.tc_waste, micro_table.fc_waste, micro_table.remarks,
                     micro_table.water_des, micro_table.sample_label, micro_table.sam_point,
                     testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, 
                     clients_table.client_name, clients_table.add_city, clients_table.add_prov,
                     micro_table.remarks, micro_table.micro_analyst, testreqtable.fsa, 
                     micro_table.mc_date_enc, micro_table.mc_date_prnt, clients_table.business_style
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
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC
                     LIMIT $offset, $pagelimit";

    try{
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
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }

}

function countData_mw(){

    $query = "SELECT COUNT(*) FROM micro_table
              WHERE remarks LIKE 'Done' OR remarks LIKE 'Printed'";
 
    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}
    
function dataFound_mw($search_comp, $search_add, $search_analyst_mc, $search_fsa, $search_bstyle, $date_start, $date_end) {

    $query = "SELECT micro_table.sam_param, micro_table.thc_potable, micro_table.tc_potable,
                     micro_table.hpc_result,
                     micro_table.ec_result, micro_table.tc_waste, micro_table.fc_waste, micro_table.remarks,
                     micro_table.water_des, micro_table.sample_label, micro_table.sam_point,
                     testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, 
                     clients_table.client_name, clients_table.add_city, clients_table.add_prov,
                     micro_table.remarks, micro_table.micro_analyst, testreqtable.fsa,
                     micro_table.mc_date_enc, micro_table.mc_date_prnt, clients_table.business_style
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
                     AND date_rcvd BETWEEN :date_start AND :date_end";
  

    try{
        $db         = getConnection();
        $search_comp = "%".$search_comp."%";
        $search_add = "%".$search_add."%";
        $search_analyst_mc = "%".$search_analyst_mc."%";
        $search_fsa = "%".$search_fsa."%";
        $search_bstyle = "%".$search_bstyle."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search_comp", $search_comp);
        $statement->bindParam("search_add", $search_add);
        $statement->bindParam("search_analyst_mc", $search_analyst_mc);
        $statement->bindParam("search_fsa", $search_fsa);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}


// RWT MONITORING REPORTING

function getByPage_mon($search_fsa, $search_bstyle, $search_add, $date_start, $date_end, $pagelimit, $offset){
   
    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, 
                     clients_table.client_name, clients_table.add_st, clients_table.add_city,
                     clients_table.add_prov, clients_table.contact, clients_table.email_add,
                     testreqtable.fsa, testreqtable.micro_count, testreqtable.pchem_count,
                     testreqtable.waste_count, testreqtable.remarks, clients_table.business_style,
                     clients_table.id_num
                     FROM testreqtable
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
                     WHERE testreqtable.fsa LIKE :search_fsa AND
                           (clients_table.add_city LIKE :search_add OR
                            clients_table.add_prov LIKE :search_add OR
                            clients_table.id_num LIKE :search_add OR
                            clients_table.company_name LIKE :search_add) AND
                            clients_table.business_style LIKE :search_bstyle
                     AND date_rcvd BETWEEN :date_start AND :date_end 
                     ORDER BY testreqtable.date_rcvd ASC, testreqtable.rwt_num ASC
                     LIMIT $offset, $pagelimit";

    try{
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
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }

}

function countData_mon(){

    $query = "SELECT COUNT(*) FROM testreqtable";
 
    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}
    
function dataFound_mon($search_fsa, $search_bstyle, $search_add, $date_start, $date_end) {

    $query = "SELECT testreqtable.date_rcvd, testreqtable.rwt_num, clients_table.company_name, 
                     clients_table.client_name, clients_table.add_st, clients_table.add_city,
                     clients_table.add_prov, clients_table.contact, clients_table.email_add,
                     testreqtable.fsa, testreqtable.micro_count, testreqtable.pchem_count,
                     testreqtable.waste_count, testreqtable.remarks, clients_table.business_style,
                     clients_table.id_num
                     FROM testreqtable
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
                     WHERE testreqtable.fsa LIKE :search_fsa AND
                           (clients_table.add_city LIKE :search_add OR
                            clients_table.add_prov LIKE :search_add OR
                            clients_table.id_num LIKE :search_add OR
                            clients_table.company_name LIKE :search_add) AND
                            clients_table.business_style LIKE :search_bstyle
                     AND date_rcvd BETWEEN :date_start AND :date_end";
  

    try{
        $db         = getConnection();
        $search_fsa = "%".$search_fsa."%";
        $search_bstyle = "%".$search_bstyle."%";
        $search_add = "%".$search_add."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search_fsa", $search_fsa);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("search_add", $search_add);
        $statement->bindParam("date_start", $date_start);
        $statement->bindParam("date_end", $date_end);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}


// MASTERLIST REPORTING

function getByPage_mL($search_com_ml, $search_add_ml, $search_bstyle, $search_afsa, $pagelimit, $offset){
   
    $query = "SELECT clients_table.*, testreqtable.date_rcvd, testreqtable.fsa, testreqtable.rwt_num FROM
             (SELECT client_id, MAX(date_rcvd) as date_rcvd, 
                                COUNT(fsa) as fsa, 
                                MAX(rwt_num) as rwt_num
              FROM testreqtable
              GROUP BY client_id) AS testreqtable
              INNER JOIN clients_table ON clients_table.id = testreqtable.client_id
              WHERE clients_table.company_name LIKE :search_com_ml
                    AND (clients_table.add_st LIKE :search_add_ml OR
                         clients_table.add_city LIKE :search_add_ml OR
                         clients_table.add_prov LIKE :search_add_ml OR
                         clients_table.c_status LIKE :search_add_ml OR
                         clients_table.id_num LIKE :search_add_ml)
                    AND clients_table.business_style LIKE :search_bstyle
                    AND clients_table.ass_fsa LIKE :search_afsa
              ORDER BY clients_table.company_name ASC
              LIMIT $offset, $pagelimit";
    try{
        $db = getConnection();
        $search_com_ml = "%".$search_com_ml."%";
        $search_add_ml = "%".$search_add_ml."%";
        $search_bstyle = "%".$search_bstyle."%";
        $search_afsa = "%".$search_afsa."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search_com_ml", $search_com_ml);
        $statement->bindParam("search_add_ml", $search_add_ml);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("search_afsa", $search_afsa);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function count_mL(){

    $query = "SELECT COUNT(*) FROM clients_table";
 
    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}
    
function dataFound_mL($search_com_ml, $search_add_ml, $search_bstyle, $search_afsa) {

    $query = "SELECT clients_table.*, testreqtable.date_rcvd, testreqtable.rwt_num FROM
             (SELECT client_id, MAX(date_rcvd) as date_rcvd, 
                                COUNT(fsa) as fsa, 
                                MAX(rwt_num) as rwt_num
              FROM testreqtable
              GROUP BY client_id) AS testreqtable
              INNER JOIN clients_table ON clients_table.id = testreqtable.client_id
              WHERE clients_table.company_name LIKE :search_com_ml
                    AND (clients_table.add_st LIKE :search_add_ml OR
                         clients_table.add_city LIKE :search_add_ml OR
                         clients_table.add_prov LIKE :search_add_ml OR
                         clients_table.c_status LIKE :search_add_ml OR
                         clients_table.id_num LIKE :search_add_ml)
                    AND clients_table.business_style LIKE :search_bstyle
                    AND clients_table.ass_fsa LIKE :search_afsa";
  
    try{
        $db         = getConnection();
        $search_com_ml = "%".$search_com_ml."%";
        $search_add_ml = "%".$search_add_ml."%";
        $search_bstyle = "%".$search_bstyle."%";
        $search_afsa = "%".$search_afsa."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search_com_ml", $search_com_ml);
        $statement->bindParam("search_add_ml", $search_add_ml);
        $statement->bindParam("search_bstyle", $search_bstyle);
        $statement->bindParam("search_afsa", $search_afsa);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}


  ?>