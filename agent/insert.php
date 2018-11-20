<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/agent.php';
 
$database = new Database();
$db = $database->getConnection();
 
$agent = new Agent($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->agent_id) &&
    !empty($data->NIC) &&
    !empty($data->telephone) &&
    !empty($data->name) &&
    !empty($data->address) &&
    !empty($data->agent_details) &&
    !empty($data->branch_number)
){
    // set product property values
    $agent->agent_id = $data->agent_id;
    $agent->NIC = $data->NIC;
    $agent->telephone = $data->telephone;
    $agent->name = $data->name;
    $agent->address = $data->address;
    $agent->agent_details = $data->agent_details;
    $agent->branch_number = $data->branch_number;
 
    // create the product
    if($agent->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Agent was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create Agent."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create agent. Data is incomplete."));
}
?>