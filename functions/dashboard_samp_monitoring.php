<?php

// MICRO
function getOngoing_m() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'MICRO'   OR
                     testreqtable.test_cat = 'MICRO & PCHEM'   OR
                     testreqtable.test_cat = 'MICRO with Special Test'   OR
                     testreqtable.test_cat = 'POOL') AND 
                     micro_table.remarks   = 'Ongoing'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getHold_m() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'MICRO'   OR
                     testreqtable.test_cat = 'MICRO & PCHEM'   OR
                     testreqtable.test_cat = 'MICRO with Special Test'   OR
                     testreqtable.test_cat = 'POOL') AND 
                     micro_table.remarks   = 'Hold' ";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getforChecking_m() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'MICRO'   OR
                     testreqtable.test_cat = 'MICRO & PCHEM'   OR
                     testreqtable.test_cat = 'MICRO with Special Test') AND 
                     micro_table.remarks   = 'for Checking' ";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getDone_m() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'MICRO'   OR
                     testreqtable.test_cat = 'MICRO & PCHEM'   OR
                     testreqtable.test_cat = 'MICRO with Special Test'   OR
                     testreqtable.test_cat = 'POOL') AND 
                     micro_table.remarks   = 'Done' ";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}


// MICRO WASTE
function getOngoing_mw() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'COLIFORM(Waste)'   OR
                     testreqtable.test_cat = 'WASTE & COLIFORM'   OR
                     testreqtable.test_cat = 'SPECIAL(WASTE) & COLIFORM') AND 
                     micro_table.remarks   = 'Ongoing'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getHold_mw() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'COLIFORM(Waste)'   OR
                     testreqtable.test_cat = 'WASTE & COLIFORM'   OR
                     testreqtable.test_cat = 'SPECIAL(WASTE) & COLIFORM') AND 
                     micro_table.remarks   = 'Hold' ";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getforChecking_mw() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'COLIFORM(Waste)'   OR
                     testreqtable.test_cat = 'WASTE & COLIFORM'   OR
                     testreqtable.test_cat = 'SPECIAL(WASTE) & COLIFORM') AND 
                     micro_table.remarks   = 'for Checking' ";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getDone_mw() {
    $query = "SELECT testreqtable.test_cat, micro_table.remarks
              FROM micro_table
              INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
              WHERE (testreqtable.test_cat = 'COLIFORM(Waste)'   OR
                     testreqtable.test_cat = 'WASTE & COLIFORM'   OR
                     testreqtable.test_cat = 'SPECIAL(WASTE) & COLIFORM') AND 
                     micro_table.remarks   = 'Done' ";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

// PCHEM
function getOngoing_pc() {
    $query = "SELECT * FROM testreqtable 
                       WHERE state = 'Ongoing' AND 
                						 test_cat NOT LIKE 'MICRO' AND 
                						 test_cat NOT LIKE 'COLIFORM(Waste)'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getHold_pc() {
    $query = "SELECT * FROM testreqtable WHERE state = 'Hold' AND 
                                               test_cat NOT LIKE 'MICRO' AND 
                                               test_cat NOT LIKE 'COLIFORM(Waste)' AND
                                               test_cat NOT LIKE 'WASTE' AND 
                                               test_cat NOT LIKE 'SPECIAL(WASTE)' AND 
                                               test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND 
                                               test_cat NOT LIKE 'WASTE & COLIFORM'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getforChecking_pc() {
    $query = "SELECT * FROM testreqtable WHERE state = 'for Checking' AND 
                                               test_cat NOT LIKE 'MICRO' AND 
                                               test_cat NOT LIKE 'COLIFORM(Waste)' AND
                                               test_cat NOT LIKE 'WASTE' AND 
                                               test_cat NOT LIKE 'SPECIAL(WASTE)' AND 
                                               test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND 
                                               test_cat NOT LIKE 'WASTE & COLIFORM'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getCompleted_pc() {
    $query = "SELECT * FROM testreqtable WHERE state = 'Completed' AND 
                                               test_cat NOT LIKE 'MICRO' AND 
                                               test_cat NOT LIKE 'COLIFORM(Waste)' AND
                                               test_cat NOT LIKE 'WASTE' AND 
                                               test_cat NOT LIKE 'SPECIAL(WASTE)' AND 
                                               test_cat NOT LIKE 'SPECIAL(WASTE) & COLIFORM' AND 
                                               test_cat NOT LIKE 'WASTE & COLIFORM'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

// WASTE
function getOngoing_w() {
    $query = "SELECT * FROM testreqtable 
                       WHERE state = 'Ongoing' AND 
                             test_cat NOT LIKE 'Micro' AND 
                             test_cat NOT LIKE 'MICRO & PCHEM' AND 
                             test_cat NOT LIKE 'MICRO with Special Test' AND 
                             test_cat NOT LIKE 'PCHEM' AND 
                             test_cat NOT LIKE 'SPECIAL(PCHEM)' AND 
                             test_cat NOT LIKE 'POOL' AND 
                             test_cat NOT LIKE 'DIALYSIS' AND 
                             test_cat NOT LIKE 'COLIFORM(Waste)'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getHold_w() {
    $query = "SELECT * FROM testreqtable WHERE state = 'Hold' AND 
                                               test_cat NOT LIKE 'PCHEM' AND 
                                               test_cat NOT LIKE 'SPECIAL(PCHEM)' AND 
                                               test_cat NOT LIKE 'POOL' AND 
                                               test_cat NOT LIKE 'DIALYSIS' AND  
                                               test_cat NOT LIKE 'MICRO & PCHEM' AND 
                                               test_cat NOT LIKE 'MICRO with Special Test' AND
                                               test_cat NOT LIKE 'COLIFORM(Waste)'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getforChecking_w() {
    $query = "SELECT * FROM testreqtable WHERE state = 'for Checking' AND  
                                               test_cat NOT LIKE 'PCHEM' AND 
                                               test_cat NOT LIKE 'SPECIAL(PCHEM)' AND 
                                               test_cat NOT LIKE 'POOL' AND 
                                               test_cat NOT LIKE 'DIALYSIS' AND  
                                               test_cat NOT LIKE 'MICRO & PCHEM' AND 
                                               test_cat NOT LIKE 'MICRO with Special Test' AND
                                               test_cat NOT LIKE 'COLIFORM(Waste)'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

function getCompleted_w() {
    $query = "SELECT * FROM testreqtable WHERE state = 'Completed' AND 
                                               test_cat NOT LIKE 'PCHEM' AND 
                                               test_cat NOT LIKE 'SPECIAL(PCHEM)' AND 
                                               test_cat NOT LIKE 'POOL' AND 
                                               test_cat NOT LIKE 'DIALYSIS' AND  
                                               test_cat NOT LIKE 'MICRO & PCHEM' AND 
                                               test_cat NOT LIKE 'MICRO with Special Test' AND
                                               test_cat NOT LIKE 'COLIFORM(Waste)'";      
    try{
        $db         = getConnection();
        $statement  = $db->prepare($query);
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_OBJ);
        return $response;
    } catch(PDOException $e){
        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
    }
}

?>