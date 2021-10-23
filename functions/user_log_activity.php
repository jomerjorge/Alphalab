<?php 

function getByPage($pagelimit, $offset, $search){
    // $query = "SELECT * FROM clients_table ORDER BY `id` LIMIT $offset, $pagelimit";

        $query = "
        SELECT * FROM userlog WHERE userlog_name 
        		 LIKE :search  
                 ORDER BY `userlog_timestamp` DESC
                 LIMIT $offset, $pagelimit";

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

function countUser(){
    $query = "SELECT COUNT(userlog_id) FROM userlog";
    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function dataFound($search) {
    $query = "SELECT * FROM userlog WHERE userlog_name LIKE :search";
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