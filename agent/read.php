<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/agent.php';
 
// instantiate database and agent object
$database = new Database();
$db = $database->getConnection();

// initialize object
$agent = new Agent($db);
 
// read agent will be here

// query products
$stmt = $agent->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // agent array
    $products_arr=array();
    $products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "agent_id" => $agent_id,
            "nic_number" => $nic_number,
            "telephone_number" => telephone_number,
            "name" => $name,
            "address" => $address,
            "agent_details" => $agent_details,
            "branch_number" => $branch_number
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
}

// no agents found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No agents found.")
    );
}

?>