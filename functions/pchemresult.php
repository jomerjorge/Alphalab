<?php 

function newPchem($sample_labelpw, $water_despw, $sam_pointp, $pw_param, $req_id)
{
    $pdo = "SELECT * FROM pw_table WHERE sample_labelpw=:sample_labelpw 
                                         AND water_despw=:water_despw
                                         AND sam_pointp=:sam_pointp
                                         AND pw_param=:pw_param 
                                         AND req_id=:req_id";
        $db = getConnection();
        $stmt = $db->prepare($pdo);
        
        $stmt->bindValue(':sample_labelpw', $sample_labelpw);
        $stmt->bindValue(':water_despw', $water_despw); 
        $stmt->bindValue(':sam_pointp', $sam_pointp); 
        $stmt->bindValue(':pw_param', $pw_param); 
        $stmt->bindValue(':req_id', $req_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row > 0)
        {   
           exit();
        }
        else{
            $query = "INSERT INTO `pw_table` (`sample_labelpw`, `water_despw`, `sam_pointp`, `pw_param`, `req_id`) 
                      VALUES (:sample_labelpw, :water_despw, :sam_pointp, :pw_param, :req_id)";
            try {
                $db         = getConnection();
                $statement  = $db->prepare($query);        
                $statement->execute(
                    array(
                        ":sample_labelpw" => $sample_labelpw,
                        ":water_despw" => $water_despw,
                        ":sam_pointp" => $sam_pointp,
                        ":pw_param" => $pw_param,
                        ":req_id" => $req_id
                         )
                );
            } catch (PDOException $e) {
                echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
            }
        }
    }

function getPchemByID($pw_id){
    $query = "SELECT * FROM pw_table WHERE pw_id=:pw_id";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("pw_id", $pw_id);
        $statement->execute();
        $response = $statement->fetchObject();
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


function getPchem($req_id){
    $query = "SELECT clients_table.company_name, testreqtable.rwt_num, testreqtable.date_rcvd, 
                     pw_table.sample_labelpw, pw_table.water_despw, pw_table.sam_pointp, pw_table.pw_param, 
                     pw_table.pw_met, pw_table.pw_result, pw_table.pw_analyst, testreqtable.fsa,
                     pw_table.pw_id 
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

function getPchemCount($req_id) {
     $query = "SELECT `req_id` FROM pw_table WHERE FIND_IN_SET($req_id, req_id)";  
       
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->bindParam("req_id", $req_id);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" getPchemCount:' . $e->getMessage() . '}}';
    }
}

function removePchem($pw_id){
      $query = "DELETE FROM pw_table WHERE pw_id=:pw_id";
      
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("pw_id", $pw_id, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


?>