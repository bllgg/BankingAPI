<?php
class AccountHolder{

    // database connection and the table name
    private $conn;
    private $table_name = "AccountHolders";

    //object propoties
    public $accountNumber;
    public $customerNIC;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read account holders
    function read(){
 
        // select all query
        $query = "SELECT * 
                FROM AccountHolders
                ORDER BY accountNumber";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    //create account holder
    function create(){
        // query to insert record
        $query = "INSERT INTO AccountHolders
                SET accountNumber= :accountNumber, customerNIC= :customerNIC";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->customerNIC=htmlspecialchars(strip_tags($this->customerNIC));

        // bind values
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":customerNIC", $this->customerNIC);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // update the account holder
    function update(){
        $query = "UPDATE
            AccountHolders
            SET customerNIC=:customerNIC
            WHERE accountNumber=:accountNumber";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->customerNIC=htmlspecialchars(strip_tags($this->customerNIC));

        // bind values
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":customerNIC", $this->customerNIC);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}
?>