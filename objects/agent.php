<?php
class Agent{
    
    // database connection and the table name
    private $conn;
    private $table_name = "bankingagents";

    // object propoties
    public $agent_id;
    public $NIC;
    public $telephone;
    public $name;
    public $address;
    public $agent_details;
    public $branch_number;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
        // select all query
        $query = "SELECT * 
                FROM bankingagents
                ORDER BY agent_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    } 
}
?>