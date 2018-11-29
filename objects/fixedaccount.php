<?php
class FixedAccount{
    
    // database connection and the table name
    private $conn;
    private $table_name = "fixedAccounts";

    // object propoties
    public $FaccountNumber;
    public $accountNumber;
    public $customerNIC;
    public $status;
    public $duration;
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
                FROM fixedAccounts
                ORDER BY FaccountNumber";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create agent
    function create(){
    
        // query to insert record
        $query = "INSERT INTO fixedAccounts
                SET FaccountNumber=:FaccountNumber, accountNumber=:accountNumber, customerNIC=:customerNIC,  status=:status, openDate=:openDate, duration=:duration, currentBalance=:currentBalance, accountDetails=:accountDetails, branch_number=:branch_number";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->FaccountNumber=htmlspecialchars(strip_tags($this->FaccountNumber));
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->customerNIC=htmlspecialchars(strip_tags($this->customerNIC));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->openDate=htmlspecialchars(strip_tags($this->openDate));
        $this->duration=htmlspecialchars(strip_tags($this->duration));
        $this->currentBalance=htmlspecialchars(strip_tags($this->currentBalance));
        $this->accountDetails=htmlspecialchars(strip_tags($this->accountDetails));
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
    
        // bind values
        $stmt->bindParam(":FaccountNumber", $this->FaccountNumber);
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":customerNIC", $this->customerNIC);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":openDate", $this->openDate);
        $stmt->bindParam(":duration", $this->duration);
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
                fixedAccounts
                SET accountNumber=:accountNumber, customerNIC=:customerNIC, status=:status, openDate=:openDate , duration=:duration, currentBalance=:currentBalance, accountDetails=:accountDetails, branch_number=:branch_number
                WHERE FaccountNumber=:FaccountNumber";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->FaccountNumber=htmlspecialchars(strip_tags($this->FaccountNumber));
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->customerNIC=htmlspecialchars(strip_tags($this->customerNIC));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->openDate=htmlspecialchars(strip_tags($this->openDate));
        $this->duration=htmlspecialchars(strip_tags($this->duration));
        $this->currentBalance=htmlspecialchars(strip_tags($this->currentBalance));
        $this->accountDetails=htmlspecialchars(strip_tags($this->accountDetails));
        $this->branch_number=htmlspecialchars(strip_tags($this->branch_number));
    
        // bind values
        $stmt->bindParam(":FaccountNumber", $this->FaccountNumber);
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":customerNIC", $this->customerNIC);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":openDate", $this->openDate);
        $stmt->bindParam(":duration", $this->duration);
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
        $query = "DELETE FROM fixedaccounts WHERE accountNumber = ?";
     
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