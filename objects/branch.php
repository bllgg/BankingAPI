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

    }

    // create branches
    function create(){

    }

    // update branches
    function update(){

    }

    // delete branches
    function delete(){
        
    }
}
?>