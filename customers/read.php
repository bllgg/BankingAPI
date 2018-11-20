<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';
 
// instantiate database and customer object
$database = new Database();
$db = $database->getConnection();

// initialize object
$customer = new Customer($db);
 
// read customer will be here

// query customer
$stmt = $customer->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // customer array
    $customers_arr=array();
    $customers_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $customer_item=array(
            "nic" => $nic,
            "name" => $name,
            "telephone" => $telephone,
            "address" => $address,
            "agent_id" => $agent_id
        );
 
        array_push($customers_arr["records"], $customer_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show customers data in json format
    echo json_encode($customers_arr);
}

// no agents found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No customers found.")
    );
}

?>