<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate customer object
include_once '../objects/transactions.php';

$database = new Database();
$db = $database->getConnection();

// initialize object
$transactions = new Transactions($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->transactionID) &&
    !empty($data->accountNumber) &&
    !empty($data->agent_id) &&
    !empty($data->transactionType) &&
    !empty($data->date) &&
    !empty($data->time) &&
    !empty($data->amount) &&
    !empty($data->details) &&
    !empty($data->charges)

){
    // set product property values
    $transactions->transactionID = $data->transactionID;
    $transactions->accountNumber = $data->accountNumber;
    $transactions->agent_id = $data->agent_id;
    $transactions->transactionType = $data->transactionType;
    $transactions->date = $data->date;
    $transactions->time = $data->time;
    $transactions->amount = $data->amount;
    $transactions->details = $data->details;
    $transactions->charges = $data->charges;

    // create the product
    if($transactions->create()){
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "transaction happened."));
    }

    else{
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to do the transaction."));
    }
}

// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to do the transaction. Data is incomplete."));
}

?>