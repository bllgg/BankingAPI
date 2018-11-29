<?php
class Account{
    
    // database connection and the table name
    private $conn;
    private $table_name = "accounts";

    // object propoties
    public $accountNumber;
    public $accountType;
    public $status;
    public $openDate;
    public $currentBalance;
    public $accountDetails;
    public $branch_number;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read accounts
    function read(){
 
        // select all query
        $query = "SELECT * 
                FROM accounts
                ORDER BY accountNumber";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create account
    function create(){
    
        // query to insert record
        $query = "INSERT INTO accounts
                SET accountNumber= :accountNumber, accountType= :accountType, status= :status, openDate= :openDate; currentBalance= :currentBalance, accountDetails= :accountDetails, branch_number= :branch_number";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->accountType=htmlspecialchars(strip_tags($this->accountType));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->openDate=htmlspecialchars(strip_tags($this->openDate));
        $this->currentBalance=htmlspecialchars(strip_tags($this->currentBalance));
        $this->accountDetails=htmlspecialchars(strip_tags($this->accountDetails));
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
    
        // bind values
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":accountType", $this->accountType);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":openDate", $this->openDate);
        $stmt->bindParam(":currentBalance", $this->currentBalance);
        $stmt->bindParam(":accountDetails", $this->accountDetails);
        $stmt->bindParam(":branch_number", $this->branch_number);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    function update(){
    
        // query to insert record
        $query = "UPDATE
                accounts
                SET accountType=:accountType, status=:status, openDate=:openDate, currentBalance=:currentBalance, accountDetails=:accountDetails, branch_number=:branch_number
                WHERE accountNumber=:accountNumber";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->accountType=htmlspecialchars(strip_tags($this->accountType));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->openDate=htmlspecialchars(strip_tags($this->openDate));
        $this->currentBalance=htmlspecialchars(strip_tags($this->currentBalance));
        $this->accountDetails=htmlspecialchars(strip_tags($this->accountDetails));
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
    
        // bind values
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":accountType", $this->accountType);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":openDate", $this->openDate);
        $stmt->bindParam(":currentBalance", $this->currentBalance);
        $stmt->bindParam(":accountDetails", $this->accountDetails);
        $stmt->bindParam(":branch_number", $this->branch_number);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    function delete(){
 
        // delete query
        $query = "DELETE FROM accounts WHERE accountNumber = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->accountNumber);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

}
?>