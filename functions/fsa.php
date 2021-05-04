<?php 

function getFsa(){
    $query = "SELECT * FROM fsa_table WHERE fsa_status = 'Active'";
                     
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

function view_fsa($search) {
    $query = "SELECT * FROM fsa_table WHERE fsa_name LIKE :search";
    try{
        $db         = getConnection();
        $search = "%".$search."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function add_fsa($fsa_name, $fsa_status) {

    $query = "INSERT INTO `fsa_table` (`fsa_name`, `fsa_status`) VALUES (:fsa_name, :fsa_status);";
    try {
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute(array(
            ":fsa_name" => $fsa_name,
            ":fsa_status" => $fsa_status
        
        ));
    } catch (PDOException $e) {
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
    }

function update_fsa($fsa_name, $fsa_status, $id){
 
    $query = "UPDATE fsa_table
              SET fsa_name = :fsa_name,
                  fsa_status = :fsa_status
                  WHERE fsa_id = :id";

    try {
        $db         = getConnection();
        $statement  = $db->prepare($query);     
        $statement->execute(
            array(
                ":fsa_name" => $fsa_name,
                ":fsa_status" => $fsa_status,
                ":id" => $id
                )
        );
    } catch (PDOException $e) {
        echo '{"error":{"text" ' . _FUNCTION_ . ':' . $e->getMessage() . '}}';
    }
    }

function del_fsa($fsa_id){
      $query = "DELETE FROM fsa_table WHERE fsa_id=:fsa_id";
      
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("fsa_id", $fsa_id, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


?>