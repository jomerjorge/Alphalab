<?php 

require("../../lib/core.php");
require("../../functions/clients.php");

$id_num = $_POST["id_num"];
$company_name = $_POST["company_name"];
$client_name = $_POST["client_name"];
$add_st = $_POST["add_st"];
$add_city = $_POST["add_city"];
$add_prov = $_POST["add_prov"];
$contact = $_POST["contact"];
$email_add = $_POST["email_add"];
$c_remarks = $_POST["c_remarks"];
$business_style = $_POST["business_style"];
$ass_fsa = $_POST["ass_fsa"];
$c_status = $_POST["c_status"];

newClient($id_num, $company_name, $client_name, $add_st, $add_city, $add_prov, 
		  $contact, $email_add, $c_remarks, $business_style, $ass_fsa, $c_status);

$response = array(
	"message" => "Successfully Added",
	"status" => true
);

echo json_encode($response);

?>