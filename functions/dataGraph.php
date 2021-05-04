<?php
// MICRO DASHBOARD
function microAnalyst($date_start, $date_end){

		$query = "SELECT COUNT( * ) as nums, micro_table.micro_analyst FROM `micro_table`
				  INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
				  WHERE (micro_table.remarks LIKE 'Done' OR micro_table.remarks LIKE 'Printed') 
				  AND testreqtable.date_rcvd BETWEEN :date_start AND :date_end 
				  GROUP BY micro_table.micro_analyst";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
		    $statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

function micro_count($date_start, $date_end){

	$query =  "SELECT 
			   sum(case when micro_table.hpc_result !='N/A' then 1 else 0 end) hpc_count,
			   sum(case when micro_table.tc_potable !='N/A' then 1 else 0 end) tc_count,
			   sum(case when micro_table.ec_result !='N/A' then 1 else 0 end) ec_count,
			   sum(case when micro_table.tc_waste !='N/A' then 1 else 0 end) tcw_count,
			   sum(case when micro_table.fc_waste !='N/A' then 1 else 0 end) fcw_count, 
			   micro_analyst
			   FROM `micro_table` 
			   INNER JOIN testreqtable ON micro_table.req_id = testreqtable.req_id
			   WHERE (micro_table.remarks LIKE 'Done' OR micro_table.remarks LIKE 'Printed') 
			   AND testreqtable.date_rcvd BETWEEN :date_start AND :date_end
			   GROUP BY micro_table.micro_analyst";


		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
		    $statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}


// PCHEM WASTE DASHBOARD
function numParam($date_start, $date_end){
		
		$query = "SELECT COUNT( * ) as nums , pw_table.pw_param FROM  `pw_table` 
				  INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id
				  WHERE testreqtable.date_rcvd BETWEEN :date_start AND :date_end
				  GROUP BY pw_table.pw_param
				  ORDER BY nums DESC";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
		    $statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

 
function searchAnalyst($pw_search, $date_start, $date_end){
		
		$query = "SELECT COUNT( * ) as nums , pw_table.pw_param 
				  FROM  `pw_table` 
				  INNER JOIN testreqtable ON pw_table.req_id = testreqtable.req_id
				  WHERE pw_table.pw_analyst LIKE :pw_search AND testreqtable.date_rcvd 
				  BETWEEN :date_start AND :date_end
				  GROUP BY pw_table.pw_param
				  ORDER BY nums DESC";


		try{
		    $db = getConnection();
        	$pw_search = "%".$pw_search."%";
		    $statement = $db->prepare($query);
        	$statement->bindParam("pw_search", $pw_search);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

// CLIENTS DASHBOARD
function num_clients(){

	$query = "SELECT COUNT(*) as num_clients, add_prov FROM  `clients_table` GROUP BY add_prov";

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

function numTest_Municipality($date_start, $date_end){

	  	$query = "SELECT 
  						 SUM(testreqtable.micro_count) as m_count,
	  				  	 SUM(testreqtable.pchem_count) as p_count,
	   				  	 SUM(testreqtable.waste_count) as w_count,
	  			  -- sum(case when testreqtable.micro_count !='' then 1 else 0 end) m_count, 
			  	  -- sum(case when testreqtable.pchem_count !='' then 1 else 0 end) p_count,
			  	  -- sum(case when testreqtable.waste_count !='' then 1 else 0 end) w_count, 
			  	  clients_table.add_city, clients_table.add_prov
	   		   	  FROM testreqtable 
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		      WHERE date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY clients_table.add_city, clients_table.add_prov";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

function numTest_wrs($date_start, $date_end){

	  	$query = "SELECT 
  						 SUM(testreqtable.micro_count) as m_count,
	  				  	 SUM(testreqtable.pchem_count) as p_count,
	   				  	 -- SUM(testreqtable.waste_count) as w_count,
	  			  -- sum(case when testreqtable.micro_count !='' then 1 else 0 end) m_count, 
			  	  -- sum(case when testreqtable.pchem_count !='' then 1 else 0 end) p_count,
			  	  -- sum(case when testreqtable.waste_count !='' then 1 else 0 end) w_count, 
			  	  clients_table.add_city, clients_table.add_prov
	   		   	  FROM testreqtable 
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		      WHERE clients_table.business_style LIKE 'WRS' AND 
	   		      		date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY clients_table.add_city, clients_table.add_prov";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

function numTest_company($date_start, $date_end){

	  	$query = "SELECT 
  						 SUM(testreqtable.micro_count) as m_count,
	  				  	 SUM(testreqtable.pchem_count) as p_count,
	   				  	 SUM(testreqtable.waste_count) as w_count,
	  			  -- sum(case when testreqtable.micro_count !='' then 1 else 0 end) m_count, 
			  	  -- sum(case when testreqtable.pchem_count !='' then 1 else 0 end) p_count,
			  	  -- sum(case when testreqtable.waste_count !='' then 1 else 0 end) w_count, 
			  	  clients_table.add_city, clients_table.add_prov
	   		   	  FROM testreqtable 
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		      WHERE clients_table.business_style NOT LIKE 'WRS' AND 
	   		      		clients_table.business_style NOT LIKE 'Residential'AND
	   		      		date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY clients_table.add_city, clients_table.add_prov";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

// FSA DASHBOARD
function byFsa($date_start, $date_end){

	  	$query = "SELECT SUM(testreqtable.micro_count) as m_count,
	  				  	 SUM(testreqtable.pchem_count) as p_count,
	   				  	 SUM(testreqtable.waste_count) as w_count, testreqtable.fsa
	   		   	  FROM testreqtable
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		   	  WHERE (testreqtable.test_cat LIKE 'MICRO' OR
	   		      		 testreqtable.test_cat LIKE 'MICRO & PCHEM' OR
	   		      		 testreqtable.test_cat LIKE 'SPECIAL(PCHEM)' OR
	   		      		 testreqtable.test_cat LIKE 'PCHEM' OR
	   		      		 testreqtable.test_cat LIKE 'POOL' OR
	   		      		 testreqtable.test_cat LIKE 'WASTE' OR
	   		      		 testreqtable.test_cat LIKE 'WASTE & COLIFORM') AND 
	   		      		date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY testreqtable.fsa";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

function totalTest($date_start, $date_end){

		// QUERY FOR ALL CLIENTS (TOTAL SAMPLES)
	  	$query = "SELECT SUM(CASE 
	  						 WHEN test_cat='MICRO' OR 
	  						 	  test_cat='MICRO & PCHEM' OR 
	  						 	  test_cat='MICRO with Special Test' OR 
	  						 	  test_cat='POOL'
	  						 THEN micro_count
	  						 ELSE 0
	  						 END) as m_count, 
	  				  	 SUM(CASE 
	  	 					 WHEN test_cat='MICRO & PCHEM' OR 
	  	 					 	  test_cat='PCHEM' OR
	  	 					 	  test_cat='SPECIAL(PCHEM)' OR
	  	 					 	  test_cat='POOL'
	  	 					 THEN pchem_count
	  	 					 ELSE 0
	  	 					 END) as p_count,
	  				  	 SUM(CASE 
	  						 WHEN test_cat='COLIFORM(Waste)' OR 
	  						 	  test_cat='WASTE & COLIFORM' OR 
	  						 	  test_cat='SPECIAL(WASTE) & COLIFORM'
	  						 THEN waste_count
	  						 ELSE 0
	  						 END) as mw_count,
	  				  	 SUM(waste_count) as w_count, fsa
	   		   	  FROM testreqtable 
	   		      WHERE date_rcvd BETWEEN :date_start AND :date_end";

        // QUERY FOR ALL CLIENTS (FSA ONLY)
	  	// $query = "SELECT SUM(CASE 
	  	// 					 WHEN test_cat='MICRO' OR 
	  	// 					 	  test_cat='MICRO & PCHEM'  OR 
	  	// 					 	  test_cat='MICRO with Special Test'
	  	// 					 THEN micro_count
	  	// 					 ELSE 0
	  	// 					 END) as m_count, 
	  	// 			  	 SUM(CASE 
	  	// 					 WHEN test_cat='MICRO & PCHEM' OR 
	  	// 					 	  test_cat='PCHEM'
	  	// 					 THEN pchem_count
	  	// 					 ELSE 0
	  	// 					 END) as p_count,
	  	// 			  	 SUM(CASE 
	  	// 					 WHEN test_cat='COLIFORM(Waste)' OR 
	  	// 					 	  test_cat='WASTE & COLIFORM'  OR 
	  	// 					 	  test_cat='SPECIAL(WASTE) & COLIFORM'
	  	// 					 THEN micro_count
	  	// 					 ELSE 0
	  	// 					 END) as mw_count,
	   // 				  	 SUM(waste_count) as w_count
	   // 		   	  FROM testreqtable 
	   // 		      WHERE fsa NOT LIKE 'Walk-in Client' AND 
	   // 		      		date_rcvd BETWEEN :date_start AND :date_end";	      

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

// function totalTestwi($date_start, $date_end){


// 	    // QUERY FOR ALL CLIENTS (WALK-IN ONLY)
// 	  	$query = "SELECT SUM(CASE 
// 	  						 WHEN test_cat='MICRO' OR 
// 	  						 	  test_cat='MICRO & PCHEM'  OR 
// 	  						 	  test_cat='MICRO with Special Test'
// 	  						 THEN micro_count
// 	  						 ELSE 0
// 	  						 END) as m_count, 
// 	  				  	 SUM(CASE 
// 	  						 WHEN test_cat='MICRO & PCHEM' OR 
// 	  						 	  test_cat='PCHEM'
// 	  						 THEN pchem_count
// 	  						 ELSE 0
// 	  						 END) as p_count,
// 	  				  	 SUM(CASE 
// 	  						 WHEN test_cat='COLIFORM(Waste)' OR 
// 	  						 	  test_cat='WASTE & COLIFORM'  OR 
// 	  						 	  test_cat='SPECIAL(WASTE) & COLIFORM'
// 	  						 THEN micro_count
// 	  						 ELSE 0
// 	  						 END) as mw_count,
// 	   				  	 SUM(waste_count) as w_count
// 	   		   	  FROM testreqtable 
// 	   		      WHERE fsa LIKE 'Walk-in Client' AND 
// 	   		      		date_rcvd BETWEEN :date_start AND :date_end";	   		      



// 		try{
// 		    $db = getConnection();
// 		    $statement = $db->prepare($query);
//         	$statement->bindParam("date_start", $date_start);
//         	$statement->bindParam("date_end", $date_end);
// 		    $statement->execute();
// 		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
//         	return $response;
// 	    } catch(PDOException $e){
// 		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
// 		    }
// }


function fsa_wrs($date_start, $date_end){

	  	$query = "SELECT SUM(micro_count) as m_count,
	  				  	 SUM(pchem_count) as p_count, testreqtable.fsa
	   		   	  FROM testreqtable 
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		      WHERE clients_table.business_style LIKE 'WRS' AND
	   		      		(testreqtable.test_cat LIKE 'MICRO' OR
	   		      		 testreqtable.test_cat LIKE 'MICRO & PCHEM' OR
	   		      		 testreqtable.test_cat LIKE 'PCHEM') AND
	   		      		date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY testreqtable.fsa";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}

function fsa_company($date_start, $date_end){

	  	$query = "SELECT SUM(micro_count) as m_count,
	  				  	 SUM(pchem_count) as p_count,
	   				  	 SUM(waste_count) as w_count, testreqtable.fsa
	   		   	  FROM testreqtable 
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		      WHERE clients_table.business_style NOT LIKE 'WRS' AND
	   		      		clients_table.business_style NOT LIKE 'Residential' AND
	   		      		(testreqtable.test_cat LIKE 'MICRO' OR
	   		      		 testreqtable.test_cat LIKE 'MICRO & PCHEM' OR
	   		      		 testreqtable.test_cat LIKE 'PCHEM' OR
	   		      		 testreqtable.test_cat LIKE 'WASTE' OR
	   		      		 testreqtable.test_cat LIKE 'WASTE & COLIFORM') AND 
	   		      		date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY testreqtable.fsa";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}


function fsa_resort($date_start, $date_end){

	  	$query = "SELECT SUM(micro_count) as m_count,
	  				  	 SUM(pchem_count) as p_count, testreqtable.fsa
	   		   	  FROM testreqtable 
	   		   	  INNER JOIN clients_table ON testreqtable.client_id = clients_table.id
	   		      WHERE clients_table.business_style LIKE 'Resort' AND
	   		      		(testreqtable.test_cat LIKE 'POOL') AND
	   		      		date_rcvd BETWEEN :date_start AND :date_end
	   		      GROUP BY testreqtable.fsa";

		try{
		    $db = getConnection();
		    $statement = $db->prepare($query);
        	$statement->bindParam("date_start", $date_start);
        	$statement->bindParam("date_end", $date_end);
		    $statement->execute();
		    $response = $statement->fetchAll(PDO::FETCH_OBJ);
        	return $response;
	    } catch(PDOException $e){
		        echo '{"error":{"text" ' . __FUNCTION__ . ':' . $e->getMessage() . '}}';
		    }
}


?>