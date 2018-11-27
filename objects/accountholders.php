<?php
class AccountHolder{

    // database connection and the table name
    private $conn;
    private $table_name = "accountholders";

    //object propoties
    public $acountNumber;
    public $cutomerNIC;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read account holders
    function read(){
 
        // select all query
        $query = "SELECT * 
                FROM accountholders
                ORDER BY acountNumber";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    //create account holder
    function create(){
        // query to insert record
        $query = "INSERT INTO accountholders
                SET acountNumber= :acountNumber, cutomerNIC= :cutomerNIC";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->acountNumber=htmlspecialchars(strip_tags($this->acountNumber));
        $this->cutomerNIC=htmlspecialchars(strip_tags($this->cutomerNIC));

        // bind values
        $stmt->bindParam(":acountNumber", $this->acountNumber);
        $stmt->bindParam(":cutomerNIC", $this->cutomerNIC);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // update the account holder
    function update(){
        $query = "UPDATE
            accountholders
            SET cutomerNIC=:cutomerNIC
            WHERE acountNumber=:acountNumber";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->acountNumber=htmlspecialchars(strip_tags($this->acountNumber));
        $this->cutomerNIC=htmlspecialchars(strip_tags($this->cutomerNIC));

        // bind values
        $stmt->bindParam(":acountNumber", $this->acountNumber);
        $stmt->bindParam(":cutomerNIC", $this->cutomerNIC);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}
?>