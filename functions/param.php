<?php
  
function newParam($testparam, $des, $limit_doh, $limit_denr) {
    $pdo = "SELECT * FROM testparamtable WHERE testparam=:testparam AND des=:des";

            $db = getConnection();
            $stmt = $db->prepare($pdo);
            
            //Bind the provided username to our prepared statement.
            $stmt->bindValue(':testparam', $testparam); 
            $stmt->bindValue(':des', $des);
            //Execute.
            $stmt->execute();
            //Fetch the row.
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row > 0)
            {
               exit();
            }else{
                $query = "INSERT INTO `testparamtable` (`testparam`, `des`, `limit_doh`, `limit_denr`)
                          VALUES (:testparam, :des, :limit_doh, :limit_denr);";
                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":testparam" => $testparam,
                            ":des" => $des,
                            ":limit_doh" => $limit_doh,
                            ":limit_denr" => $limit_denr
                             )
                    );
                } catch (PDOException $e) {
                    echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                }
        }
}

function getParamByID($param_id){
    $query = "SELECT * FROM testparamtable WHERE param_id=:param_id";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("param_id", $param_id);
        $statement->execute();
        $response = $statement->fetchObject();
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getParam(){
    $query = "SELECT * FROM testparamtable";
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

function searchParam($description) {
    $query = "SELECT * FROM testparamtable WHERE testparam LIKE CONCAT('%' , :description , '%') || des LIKE CONCAT('%' , :description , '%')";
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->bindParam("description", $description);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" searchParam:' . $e->getMessage() . '}}';
    }
}

function updateParam($testparam, $des, $limit_doh, $limit_denr, $param_id){
     $pdo = "SELECT * FROM testparamtable WHERE testparam=:testparam AND des=:des";

            $db = getConnection();
            $stmt = $db->prepare($pdo);
            
            //Bind the provided username to our prepared statement.
            $stmt->bindValue(':testparam', $testparam); 
            $stmt->bindValue(':des', $des);
            //Execute.
            $stmt->execute();
            //Fetch the row.
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row > 0)
            {
               exit();
            }else{
                $query = "UPDATE `testparamtable`
                          SET `testparam` = :testparam,
                              `des` = :des,
                              `limit_doh` = :limit_doh,
                              `limit_denr` = :limit_denr,
                              WHERE `param_id` = :param_id";

                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":testparam" => $testparam,
                            ":des" => $des,
                            ":limit_doh" => $limit_doh,
                            ":limit_denr" => $limit_denr,
                            ":param_id" => $param_id
                            )
                    );
                } catch (PDOException $e) {
                    echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                }
            }
}



?>