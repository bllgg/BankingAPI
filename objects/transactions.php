<?php
class Transactions{

    // database connection and the table name
    private $conn;
    private $table_name = "transactions";

    //object propoties
    public $transactionID;
    public $accountNumber;
    public $agent_id;
    public $transactionType;
    public $date;
    public $time;
    public $amount;
    public $details;
    public $charges;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read account holders
    function read(){
 
        // select all query
        $query = "SELECT * 
                FROM transactions
                ORDER BY transactionID";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    //create account holder
    function create(){
        // query to insert record
        $query = "INSERT INTO transactions
                SET transactionID= :transactionID, accountNumber= :accountNumber, agent_id= :agent_id, transactionType= :transactionType, date= :date, time= :time, amount= :amount, details= :details, charges= :charges";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->transactionID=htmlspecialchars(strip_tags($this->transactionID));
        $this->accountNumber=htmlspecialchars(strip_tags($this->accountNumber));
        $this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
        $this->transactionType=htmlspecialchars(strip_tags($this->transactionType));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->time=htmlspecialchars(strip_tags($this->time));
        $this->amount=htmlspecialchars(strip_tags($this->amount));
        $this->details=htmlspecialchars(strip_tags($this->details));
        $this->charges=htmlspecialchars(strip_tags($this->charges));

        // bind values
        $stmt->bindParam(":transactionID", $this->transactionID);
        $stmt->bindParam(":accountNumber", $this->accountNumber);
        $stmt->bindParam(":agent_id", $this->agent_id);
        $stmt->bindParam(":transactionType", $this->transactionType);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":time", $this->time);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":details", $this->details);
        $stmt->bindParam(":charges", $this->charges);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}    
?>