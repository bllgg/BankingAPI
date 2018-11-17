<?php
class Branch{

    // database connection and the table name
    private $conn;
    private $table_name = "branches";

    // object properties
    public $branch_number;
    public $city;

    // constructor woth $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read branches
    function read(){
        // select all query
        $query = "SELECT * 
                FROM branches
                ORDER BY branch_number";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create branches
    function create(){
        // query to insert record
        $query = "INSERT INTO branches
                SET branch_number=:branch_number, city=:city";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->branch_number = htmlspecialchars(strip_tags($this->branch_number));
        $this->city = htmlspecialchars(strip_tags($this->city));

        //bind values
        $stmt->bindParam(":branch_number",$this->branch_number);
        $stmt->bindParam(":city",$this->city);

        //execute query
        if ($stmt->execute()){
            return true;
        }
        return false;

    }

    // update branches
    function update(){
        $query = "UPDATE
        branches
        SET city=:city
        WHERE branch_number=:branch_number";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
        $this->city=htmlspecialchars(strip_tags($this->city));

        // bind values
        $stmt->bindParam(":branch_number", $this->branch_number);
        $stmt->bindParam(":city", $this->city);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // delete branches
    function delete(){
        // delete query
        $query = "DELETE FROM branches WHERE branch_number = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->branch_number);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>