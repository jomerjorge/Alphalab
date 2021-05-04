<?php 

// function checkRWT

function newRequest($test_cat, $rwt_num, $date_rcvd, $date_sample, $micro_count, 
                    $pchem_count, $waste_count, $fsa, $state, $remarks, $client_id){

                $query = "INSERT INTO `testreqtable` (`test_cat`, `rwt_num`, `date_rcvd`, `date_sample`, 
                                            `micro_count`, `pchem_count`, `waste_count`, `fsa`, `state`,
                                             `remarks`, `client_id`) 
                          VALUES (:test_cat, :rwt_num, :date_rcvd, :date_sample, :micro_count, 
                                    :pchem_count, :waste_count, :fsa, :state, :remarks, :client_id)";
                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":test_cat" => $test_cat,
                            ":rwt_num" => $rwt_num,
                            ":date_rcvd" => $date_rcvd,
                            ":date_sample" => $date_sample,
                            ":micro_count" => $micro_count,
                            ":pchem_count" => $pchem_count,
                            ":waste_count" => $waste_count,
                            ":fsa" => $fsa,
                            ":state" => $state,
                            ":remarks" => $remarks,
                            ":client_id" => $client_id
                             )
                    );
                } catch (PDOException $e) {
                    echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                }
          
}
 
function getRequestByID($req_id){
    $query = "SELECT * FROM testreqtable WHERE req_id=:req_id";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("req_id", $req_id);
        $statement->execute();
        $response = $statement->fetchObject();
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getRequest($client_id){
    $query = "SELECT testreqtable.rwt_num, clients_table.company_name, clients_table.client_name,
                     clients_table.add_st, clients_table.add_city, clients_table.add_prov, 
                     testreqtable.date_rcvd, testreqtable.test_cat, testreqtable.date_sample, 
                     testreqtable.micro_count, testreqtable.pchem_count, testreqtable.waste_count,
                     testreqtable.fsa, testreqtable.state, testreqtable.remarks, testreqtable.req_id,
                     clients_table.c_remarks
                     FROM testreqtable 
                     INNER JOIN clients_table ON testreqtable.client_id = clients_table.id 
                     WHERE clients_table.id = :client_id ORDER BY testreqtable.date_rcvd desc";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("client_id", $client_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function updateRequest($test_cat, $rwt_num, $date_rcvd, $date_sample, $micro_count, $pchem_count,
                       $waste_count, $fsa, $state, $remarks, $client_id, $req_id){

                $query = "UPDATE `testreqtable`
                          SET `test_cat` = :test_cat,
                              `rwt_num` = :rwt_num,
                              `date_rcvd` = :date_rcvd,
                              `date_sample` = :date_sample,
                              `micro_count` = :micro_count,
                              `pchem_count` = :pchem_count,
                              `waste_count` = :waste_count,
                              `fsa` = :fsa,
                              `state` = :state,
                              `remarks` = :remarks,
                              `client_id` = :client_id
                              WHERE `req_id` = :req_id";

                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":test_cat" => $test_cat,
                            ":rwt_num" => $rwt_num,
                            ":date_rcvd" => $date_rcvd,
                            ":date_sample" => $date_sample,
                            ":micro_count" => $micro_count,
                            ":pchem_count" => $pchem_count,
                            ":waste_count" => $waste_count,
                            ":fsa" => $fsa,
                            ":state" => $state,
                            ":remarks" => $remarks,
                            ":client_id" => $client_id,
                            ":req_id" => $req_id
                            )
                    );
                } catch (PDOException $e) {
                    echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                }
            
}

function chkrwt($rwt_num){
    $query = "SELECT * FROM testreqtable WHERE rwt_num = :rwt_num";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("rwt_num", $rwt_num);
        $statement->execute();
        $response = $statement->fetch(PDO::FETCH_ASSOC);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


function updateStatus($state, $date_com_pw, $date_prnt_pw, $client_id, $req_id){

                $query = "UPDATE `testreqtable`
                          SET `state` = :state,
                              `date_com_pw` = :date_com_pw,
                              `date_prnt_pw` = :date_prnt_pw,
                              `client_id` = :client_id
                              WHERE `req_id` = :req_id";

                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":state" => $state,
                            ":date_com_pw" => $date_com_pw,
                            ":date_prnt_pw" => $date_prnt_pw,
                            ":client_id" => $client_id,
                            ":req_id" => $req_id
                            )
                    );
                } catch (PDOException $e) {
                    echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                }      
    }


function removeReq($req_id){
      $query = "DELETE FROM testreqtable WHERE req_id=:req_id";
      
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("req_id", $req_id, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


// function newDataSumm($ds_client_id, $d_jan, $d_feb, $d_mar, $d_apr, $d_may, $d_jun,
//                      $d_jul, $d_aug, $d_sept, $d_oct, $d_nov, $d_dec)
// {

// $query = "INSERT INTO `datasummary` (`ds_client_id`, `d_jan`, `d_feb`, `d_mar`, `d_apr`, `d_may`, 
//                                      `d_jun`, `d_jul`, `d_aug`, `d_sept`, `d_oct`, `d_nov`, `d_dec`) 
//                                 VALUES (:ds_client_id, :d_jan, :d_feb, :d_mar, :d_apr, :d_may, :d_jun,
//                                         :d_jul, :d_aug, :d_sept, :d_oct, :d_nov, :d_dec)";
//                 try {
//                     $db         = getConnection();
//                     $statement  = $db->prepare($query);        
//                     $statement->execute(
//                         array(
//                             ":ds_client_id" => $ds_client_id,
//                             ":d_jan" => $d_jan,
//                             ":d_feb" => $d_feb,
//                             ":d_mar" => $d_mar,
//                             ":d_apr" => $d_apr,
//                             ":d_may" => $d_may,
//                             ":d_jun" => $d_jun,
//                             ":d_jul" => $d_jul,
//                             ":d_aug" => $d_aug,
//                             ":d_sept" => $d_sept,
//                             ":d_oct" => $d_oct,
//                             ":d_nov" => $d_nov,
//                             ":d_dec" => $d_dec
//                              )
//                     );
//                 } catch (PDOException $e) {
//                     echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
//                 }
// }

?>