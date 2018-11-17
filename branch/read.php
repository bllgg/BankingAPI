<?php
// required headrers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/branch.php';

// instantiate database and branch object
$database = new Database();
$db = $database->getConnection();

// initiate object
$branch = new Branch($db);

// read branches will be here

// query products
$stmt = $branch->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num > 0){

    // branches array
    $branches_arr=array();
    $branches_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $branch_item=array(
            "branch_number" => $branch_number,
            "city" => $city
        );

        array_push($branches_arr["records"], $branch_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    //show branches data in json format
    echo json_encode($branches_arr);
}

// no branches found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No branches found.")
    );
}

?>