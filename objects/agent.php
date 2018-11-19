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

    // create agent
    function create(){
    
        // query to insert record
        $query = "INSERT INTO bankingagents
                SET agent_id=:agent_id, NIC=:NIC, telephone=:telephone, name=:name, address=:address, agent_details=:agent_details, branch_number=:branch_number";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
        $this->NIC=htmlspecialchars(strip_tags($this->NIC));
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->agent_details=htmlspecialchars(strip_tags($this->agent_details));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
    
        // bind values
        $stmt->bindParam(":agent_id", $this->agent_id);
        $stmt->bindParam(":NIC", $this->NIC);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":agent_details", $this->agent_details);
        $stmt->bindParam(":branch_number", $this->branch_number);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // update the agent
    function update(){

        $query = "UPDATE
                bankingagents
                SET NIC=:NIC, telephone=:telephone, name=:name, address=:address, agent_details=:agent_details, branch_number=:branch_number
                WHERE agent_id=:agent_id";

        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
        $this->NIC=htmlspecialchars(strip_tags($this->NIC));
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->agent_details=htmlspecialchars(strip_tags($this->agent_details));
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
    
        // bind values
        $stmt->bindParam(":agent_id", $this->agent_id);
        $stmt->bindParam(":NIC", $this->NIC);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":agent_details", $this->agent_details);
        $stmt->bindParam(":branch_number", $this->branch_number);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    function delete(){
 
        // delete query
        $query = "DELETE FROM bankingagents WHERE agent_id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->agent_id);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

}
?>