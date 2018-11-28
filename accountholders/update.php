<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/accountholder.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare account object
$jah = new AccountHolder($db);

// get id of account to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of account to be edited
$jah->accountNumber = $data->accountNumber;

// set account property values
$jah->customerNIC = $data->customerNIC;

// update the account
if($jah->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Account holder was updated."));
}

else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update Account holder."));
}

?>