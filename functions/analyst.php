<?php 

function getChem_Analyst(){
    $query = "SELECT * FROM analyst_table WHERE (analyst_dept = 'PCHEM DEPT' OR 
                                                 analyst_dept = 'MICRO-PCHEM DEPT') AND 
                                                 analyst_status = 'Active'";

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

function getChem_Analyst_inac(){
    $query = "SELECT * FROM analyst_table WHERE analyst_dept = 'PCHEM DEPT'";

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

function getMicro_Analyst(){
    $query = "SELECT * FROM analyst_table WHERE (analyst_dept = 'MICRO DEPT' OR 
                                                 analyst_dept = 'MICRO-PCHEM DEPT') AND
                                                 analyst_status = 'Active'";

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

function view_analyst($search) {
    $query = "SELECT * FROM analyst_table WHERE analyst_name LIKE :search ORDER BY analyst_status ASC";
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

function add_analyst($analyst_name, $analyst_dept, $analyst_status) {

    $query = "INSERT INTO `analyst_table` (`analyst_name`, `analyst_dept`, `analyst_status`) VALUES (:analyst_name, :analyst_dept, :analyst_status);";
    try {
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute(array(
            ":analyst_name" => $analyst_name,
            ":analyst_dept" => $analyst_dept,
            ":analyst_status" => $analyst_status
        
        ));
    } catch (PDOException $e) {
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
    }

function update_analyst($analyst_name, $analyst_dept, $analyst_status, $id){
 
    $query = "UPDATE analyst_table
              SET analyst_name = :analyst_name,
                  analyst_dept = :analyst_dept,
                  analyst_status = :analyst_status
                  WHERE analyst_id = :id";

    try {
        $db         = getConnection();
        $statement  = $db->prepare($query);     
        $statement->execute(
            array(
                ":analyst_name" => $analyst_name,
                ":analyst_dept" => $analyst_dept,
                ":analyst_status" => $analyst_status,
                ":id" => $id
                )
        );
    } catch (PDOException $e) {
        echo '{"error":{"text" ' . _FUNCTION_ . ':' . $e->getMessage() . '}}';
    }
    }

function del_analyst($analyst_id){
      $query = "DELETE FROM analyst_table WHERE analyst_id=:analyst_id";
      
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("analyst_id", $analyst_id, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

?>