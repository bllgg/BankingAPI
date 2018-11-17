<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/branch.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare branch object
$branch = new Branch($db);

// get id of branch to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of branch to be edited
$branch->branch_number = $data->branch_number;

// set branch property values
$branch->city = $data->city;

// update the branch
if($branch->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Branch was updated."));
}

else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update branch."));
}

?>