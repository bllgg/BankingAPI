<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate Account object
include_once '../objects/account.php';
 
$database = new Database();
$db = $database->getConnection();
 
$account = new Account($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->accountNumber) &&
    !empty($data->accountType) &&
    !empty($data->status) &&
    !empty($data->openDate) &&
    !empty($data->currentBalance) &&
    !empty($data->accountDetails) &&
    !empty($data->branch_number)
){
    
    // set product property values
    $account->accountNumber = $data->accountNumber;
    $account->accountType = $data->accountType;
    $account->status = $data->status;
    $account->openDate = $data->openDate;
    $account->currentBalance = $data->currentBalance;
    $account->accountDetails = $data->accountDetails;
    $account->branch_number = $data->branch_number;
 
    // create the account
    if($account->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "account was created."));
    }
 
    // if unable to create the Account, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create account."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create account. Data is incomplete."));
}
?>