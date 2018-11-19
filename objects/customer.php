<?php
class Customer{

    // database connection and the table name
    private $conn;
    private $table_name = "customers";

    //object propoties
    public $NIC;
    public $name;
    public $telephone;
    public $address;
    public $agent_id;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read customers
    function read(){
 
        // select all query
        $query = "SELECT * 
                FROM customers
                ORDER BY NIC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    //create customer
    function create(){
        // query to insert record
        $query = "INSERT INTO customers
                SET NIC=:NIC, name=:name, telephone=:telephone, address=:address, agent_id=:agent_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->NIC=htmlspecialchars(strip_tags($this->NIC));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
        

        // bind values
        $stmt->bindParam(":NIC", $this->NIC);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":agent_id", $this->agent_id);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

}

?>