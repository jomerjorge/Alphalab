<?php 

// VIEWING OF USER ACCOUNT RECORDS
function view_useraccount(){ 
    $query = "SELECT * FROM users";
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

function update_useraccount($user_username, $user_password, $user_usertype, $id){
 
    $query = "UPDATE users
              SET user_username = :user_username,
                  user_password = :user_password,
                  user_usertype = :user_usertype
                  WHERE id = :id";

    try {
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $passwordHash = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12)); // create hash password
        $statement->execute(
            array(
                ":user_username" => $user_username,
                ":user_password" => $passwordHash,
                ":user_usertype" => $user_usertype,
                ":id" => $id
                )
        );
    } catch (PDOException $e) {
        echo '{"error":{"text" ' . _FUNCTION_ . ':' . $e->getMessage() . '}}';
    }

}


function new_useraccount($user_username, $user_password, $user_usertype) {

    $sql = "SELECT COUNT(user_username) AS num FROM users WHERE user_username = :username";
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $user_username); 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0)
    {
       exit();
    }

    else
    {
        $query = "INSERT INTO `users` (`user_username`, `user_password`, `user_usertype`) VALUES (:user_username, :user_password, :user_usertype);";
    try {
        $db         = getConnection();
        $statement  = $db->prepare($query); 
        $passwordHash = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12));  // create hash password
        $statement->execute(array(
            ":user_username" => $user_username,
            ":user_password" => $passwordHash,
            ":user_usertype" => $user_usertype
        
        ));
    } catch (PDOException $e) {
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}
    }


function del_useraccount($id){
      $query = "DELETE FROM users WHERE id=:id";
      
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("id", $id, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}
    
?>