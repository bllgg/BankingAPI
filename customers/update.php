<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare branch object
$customer = new Customer($db);

// get id of branch to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of branch to be edited
$customer->nic = $data->nic;

// set branch property values
$customer->name = $data->name;
$customer->telephone = $data->telephone;
$customer->address = $data->address;
$customer->agent_id = $data->agent_id;

// update the branch
if($customer->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Customer was updated."));
}

else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update customer."));
}

?>