<?php
 
function newClient($id_num, $company_name, $client_name, $add_st, $add_city, $add_prov, 
                   $contact, $email_add, $c_remarks, $business_style, $ass_fsa, $c_status) {

            $pdo = "SELECT * FROM clients_table WHERE (company_name=:company_name AND 
                                                       client_name=:client_name AND 
                                                       add_st=:add_st AND 
                                                       add_city=:add_city AND 
                                                       add_prov=:add_prov AND 
                                                       business_style=:business_style AND 
                                                       ass_fsa=:ass_fsa AND 
                                                       c_status=:c_status) 
                                                OR (company_name=:company_name AND  
                                                    client_name=:client_name AND 
                                                    add_st=:add_st AND 
                                                    add_city=:add_city AND 
                                                    add_prov=:add_prov AND 
                                                    business_style=:business_style AND 
                                                    ass_fsa=:ass_fsa AND 
                                                    c_status=:c_status)";
            $db = getConnection();
            $stmt = $db->prepare($pdo);
            
            //Bind the provided username to our prepared statement.
            $stmt->bindValue(':company_name', $company_name); 
            $stmt->bindValue(':client_name', $client_name);
            $stmt->bindValue(':add_st', $add_st);
            $stmt->bindValue(':add_city', $add_city);
            $stmt->bindValue(':add_prov', $add_prov);
            $stmt->bindValue(':business_style', $business_style);
            $stmt->bindValue(':ass_fsa', $ass_fsa);
            $stmt->bindValue(':c_status', $c_status);
            //Execute.
            $stmt->execute();
            //Fetch the row.
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row > 0)
            {   
               exit();
            }
            else{
                $query = "INSERT INTO `clients_table` (`id_num`, `company_name`, `client_name`, 
                                                       `add_st`, `add_city`, `add_prov`, `contact`,
                                                       email_add, c_remarks, `business_style`, `ass_fsa`, `c_status`) 
                                                VALUES (:id_num, :company_name, :client_name, 
                                                        :add_st, :add_city, :add_prov, :contact, 
                                                        :email_add, :c_remarks, :business_style, :ass_fsa, :c_status)";
                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":id_num" => $id_num,
                            ":company_name" => $company_name,
                            ":client_name" => $client_name,
                            ":add_st" => $add_st,
                            ":add_city" => $add_city,
                            ":add_prov" => $add_prov,
                            ":contact" => $contact,
                            ":email_add" => $email_add,
                            ":c_remarks" => $c_remarks,
                            ":business_style" => $business_style,
                            ":ass_fsa" => $ass_fsa,
                            ":c_status" => $c_status
                             )
                        );
                    } catch (PDOException $e) {
                        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                        }
                }
}
 

//SEARCH WITH PAGINATION clients.html
function getByPage_c($description, $desc_add, $pagelimit, $offset) {

    $query = "SELECT * FROM clients_table WHERE (company_name LIKE :description OR
                                                       id_num LIKE :description OR 
                                               business_style LIKE :description OR 
                                                     c_status LIKE :description OR 
                                                client_name LIKE :description) AND 
                                                         (add_st LIKE :desc_add OR
                                                        add_city LIKE :desc_add OR 
                                                        add_prov LIKE :desc_add)
                                    ORDER BY `id_num` DESC
                                    LIMIT $offset, $pagelimit";


    try{
        $db         = getConnection();
        $description = "%".$description."%";
        $desc_add = "%".$desc_add."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("description", $description);
        $statement->bindParam("desc_add", $desc_add);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" searchClients:' . $e->getMessage() . '}}';
    }
}

function count_c(){

    $query = "SELECT COUNT(*) FROM clients_table"; 
            
    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function dataFound_c($description, $desc_add) {

    $query = "SELECT * FROM clients_table WHERE (company_name LIKE :description OR
                                                       id_num LIKE :description OR 
                                               business_style LIKE :description OR  
                                                     c_status LIKE :description OR 
                                                client_name LIKE :description) AND 
                                                         (add_st LIKE :desc_add OR
                                                        add_city LIKE :desc_add OR 
                                                        add_prov LIKE :desc_add)
                                            ORDER BY `id_num` DESC";


    try{
        $db         = getConnection();
        $description = "%".$description."%";
        $desc_add = "%".$desc_add."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("description", $description);
        $statement->bindParam("desc_add", $desc_add);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" searchClients:' . $e->getMessage() . '}}';
    }
}


// SEARCH BY RWT/RWWT
function searchBy_rwt($description) {
    
   $query = "
        SELECT * 
        FROM testreqtable
        INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
        WHERE testreqtable.rwt_num LIKE :description";

    try{
        $db         = getConnection();
        $description = "%".$description."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("description", $description);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" searchClients:' . $e->getMessage() . '}}';
    }
}
// SEARCH BY RWT/RWWT
function updateClients($id_num, $company_name, $client_name, $add_st, $add_city, $add_prov,
                       $contact, $email_add, $c_remarks, $business_style, $ass_fsa, $c_status, $id){
   
                $query = "UPDATE `clients_table`
                          SET `id_num` = :id_num,
                              `company_name` = :company_name,
                              `client_name` = :client_name,
                              `add_st` = :add_st,
                              `add_city` = :add_city,
                              `add_prov` = :add_prov,
                              `contact` = :contact,
                              `email_add` = :email_add,
                              `c_remarks` = :c_remarks,
                              `business_style` = :business_style,
                              `ass_fsa` = :ass_fsa,
                              `c_status` = :c_status
                              WHERE `id` = :id";

                try {
                    $db         = getConnection();
                    $statement  = $db->prepare($query);        
                    $statement->execute(
                        array(
                            ":id_num" => $id_num,
                            ":company_name" => $company_name,
                            ":client_name" => $client_name,
                            ":add_st" => $add_st,
                            ":add_city" => $add_city,
                            ":add_prov" => $add_prov,
                            ":contact" => $contact,
                            ":email_add" => $email_add,
                            ":c_remarks" => $c_remarks,
                            ":business_style" => $business_style,
                            ":ass_fsa" => $ass_fsa,
                            ":c_status" => $c_status,
                            ":id" => $id
                            )
                    );
                } catch (PDOException $e) {
                    echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
                }
            // }
}

function checkId($id_num){
    $query = "SELECT * FROM clients_table WHERE id_num = :id_num";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->bindParam("id_num", $id_num);
        $statement->execute();
        $response = $statement->fetch(PDO::FETCH_ASSOC);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getLastClientId(){
    $query = "SELECT id_num FROM clients_table ORDER BY id DESC LIMIT 1";
    try{
        $db = getConnection();
        $statement = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetch(PDO::FETCH_ASSOC);
        $lastId = end($response);
        return $lastId;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

// VIEW RECORDS.HTML FUNCTIONS

function getByPage($pagelimit, $offset, $search, $searchBy_add_vr){
    // $query = "SELECT * FROM clients_table ORDER BY `id` LIMIT $offset, $pagelimit";

        $query = "
        SELECT * FROM clients_table WHERE (company_name LIKE :search OR 
                                                 id_num LIKE :search OR
                                         business_style LIKE :search OR 
                                               c_status LIKE :search OR 
                                           client_name LIKE :search) AND
                                       (add_st LIKE :searchBy_add_vr OR
                                      add_city LIKE :searchBy_add_vr OR
                                      add_prov LIKE :searchBy_add_vr) 
                                    ORDER BY `id_num` DESC
                                    LIMIT $offset, $pagelimit";

    try{
        $db = getConnection();
        $search = "%".$search."%";
        $searchBy_add_vr = "%".$searchBy_add_vr."%";
        $statement = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->bindParam("searchBy_add_vr", $searchBy_add_vr);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function countClients(){
    $query = "SELECT COUNT(id) FROM clients_table";
    try{
        $db = getConnection();
        $totalrecord = $db->query($query)->fetchColumn(); 
        return $totalrecord;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function dataFound($search, $searchBy_add_vr) {
    $query = "SELECT * FROM clients_table WHERE (company_name LIKE :search OR 
                                                       id_num LIKE :search OR
                                               business_style LIKE :search OR
                                                     c_status LIKE :search OR 
                                                client_name LIKE :search) AND
                                             (add_st LIKE :searchBy_add_vr OR
                                            add_city LIKE :searchBy_add_vr OR
                                            add_prov LIKE :searchBy_add_vr)
                                                    ORDER BY `id_num` DESC";
    try{
        $db         = getConnection();
        $search = "%".$search."%";
        $searchBy_add_vr = "%".$searchBy_add_vr."%";
        $statement  = $db->prepare($query);
        $statement->bindParam("search", $search);
        $statement->bindParam("searchBy_add_vr", $searchBy_add_vr);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" dataFound:' . $e->getMessage() . '}}';
    }
}

?>