<?php 

function addMicroWaste($sam_param, $sample_label, $water_des, $sam_place, $tc_potable,
                       $thc_potable, $hpc_result, $ec_result, $tc_waste, $fc_waste, $remarks, $req_id)
{
        $pdo = "SELECT * FROM micro_table WHERE sam_param=:sam_param
                                          AND sample_label=:sample_label 
                                          AND water_des=:water_des
                                          AND req_id=:req_id";
        $db = getConnection();
        $stmt = $db->prepare($pdo);

        $stmt->bindValue(':sam_param', $sam_param);         
        $stmt->bindValue(':sample_label', $sample_label); 
        $stmt->bindValue(':water_des', $water_des);
        $stmt->bindValue(':req_id', $req_id);
        //Execute.
        $stmt->execute();
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row > 0)
        {   
           exit();
        }
        else{
            $query = "INSERT INTO `micro_table` (`sam_param`, `sample_label`, `water_des`, `sam_place`,
                                                 `tc_potable`, `thc_potable`, `hpc_result`, `ec_result`,
                                                 `tc_waste`, `fc_waste`, `remarks`, `req_id`) 
                      VALUES (:sam_param, :sample_label, :water_des, :sam_place, :tc_potable,
                              :thc_potable, :hpc_result, :ec_result, :tc_waste, :fc_waste, :remarks, :req_id)";
            try {
                $db         = getConnection();
                $statement  = $db->prepare($query);        
                $statement->execute(
                    array(
                        ":sam_param" => $sam_param,
                        ":sample_label" => $sample_label,
                        ":water_des" => $water_des,
                        ":sam_place" => $sam_place,
                        ":tc_potable" => $tc_potable,
                        ":thc_potable" => $thc_potable,
                        ":hpc_result" => $hpc_result,
                        ":ec_result" => $ec_result,
                        ":tc_waste" => $tc_waste,
                        ":fc_waste" => $fc_waste,
                        ":remarks" => $remarks,
                        ":req_id" => $req_id
                         )
                );
            } catch (PDOException $e) {
                echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
            }
        }
    }


function getMicroWasteResultByID($micro_id){
    $query = "SELECT * FROM micro_table WHERE micro_id=:micro_id";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("micro_id", $micro_id);
        $statement->execute();
        $response = $statement->fetchObject();
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getMicroWasteResult($req_id){
    $query = "SELECT clients_table.company_name, clients_table.add_st, clients_table.add_city, 
                     clients_table.add_prov, testreqtable.date_rcvd, testreqtable.rwt_num,
                     micro_table.sam_param, micro_table.water_des, micro_table.sample_label,
                     micro_table.sam_place, micro_table.sam_point, micro_table.thc_potable,
                     micro_table.tc_potable, micro_table.hpc_result, micro_table.ec_result,
                     micro_table.tc_waste, micro_table.fc_waste, testreqtable.fsa,
                     micro_table.micro_analyst, micro_table.remarks, micro_table.micro_id
                     FROM ((micro_table 
                     INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id)
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

function getMicroWasteCount($req_id) {
    $query = "SELECT `req_id` FROM micro_table WHERE FIND_IN_SET($req_id, req_id)";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->bindParam("req_id", $req_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" getMicroCount:' . $e->getMessage() . '}}';
    }
}


function updateMicroWaste($sam_param, $sample_label, $water_des, $sam_place, $tc_waste,
                          $fc_waste, $micro_id, $req_id)
{
          $query = "UPDATE `micro_table`
                    SET `sam_param` = :sam_param,
                        `sample_label` = :sample_label,
                        `water_des` = :water_des,
                        `sam_place` = :sam_place,
                        `tc_waste` = :tc_waste,
                        `fc_waste` = :fc_waste,
                        `req_id` = :req_id
                    WHERE `micro_id` = :micro_id";

        try {
            $db         = getConnection();
            $statement  = $db->prepare($query);        
            $statement->execute(
                array(
                    ":sam_param" => $sam_param,
                    ":sample_label" => $sample_label,
                    ":water_des" => $water_des,
                    ":sam_place" => $sam_place,
                    ":tc_waste" => $tc_waste,
                    ":fc_waste" => $fc_waste,
                    ":req_id" => $req_id,
                    ":micro_id" => $micro_id
                    )
            );
        } catch (PDOException $e) {
            echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
        }
}




function removeMicroWaste($micro_id){
      $query = "DELETE FROM micro_table WHERE micro_id=:micro_id";
      
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("micro_id", $micro_id, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

?>