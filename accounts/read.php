<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/account.php';
 
// instantiate database and account object
$database = new Database();
$db = $database->getConnection();

// initialize object
$account = new Account($db);
 
// read accounts will be here

// query products
$stmt = $account->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // agent array
    $accounts_arr=array();
    $accounts_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $account_item=array(
            "accountNumber" => $accountNumber,
            "accountType" => $accountType,
            "status" => $status,
            "currentBalance" => $currentBalance,
            "accountDetails" => $accountDetails,
            "branch_number" => $branch_number
        );
 
        array_push($accounts_arr["records"], $account_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($accounts_arr);
}

// no agents found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No accounts found.")
    );
}

?>