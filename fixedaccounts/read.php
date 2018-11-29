<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/fixedaccount.php';
 
// instantiate database and account object
$database = new Database();
$db = $database->getConnection();

// initialize object
$fixedaccount = new FixedAccount($db);
 
// read accounts will be here

// query products
$stmt = $fixedaccount->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // agent array
    $fixedaccounts_arr=array();
    $fixedaccounts_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $fixedaccount_item=array(
            "FaccountNumber" => $FaccountNumber,
            "accountNumber" => $accountNumber,
            "customerNIC" => $customerNIC,
            "status" => $status,
            "openDate" => $openDate,
            "duration" => $duration,
            "currentBalance" => $currentBalance,
            "accountDetails" => $accountDetails,
            "branch_number" => $branch_number
        );
 
        array_push($fixedaccounts_arr["records"], $fixedaccount_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($fixedaccounts_arr);
}

// no agents found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No Fixed accounts found.")
    );
}

?>