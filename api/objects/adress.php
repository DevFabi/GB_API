<?php
class Adress{
 
    // database connection and table name
    private $conn;
    private $table_name = "adress";
 
    // object properties
    public $id;
    public $adress;
    public $codepostal;
    public $ville;
    public $created;
    public $deleted;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, adress, codepostal,ville
                FROM
                    " . $this->table_name . "
                ORDER BY
                    adress";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    // used by select drop-down list
public function read(){
 
    //select all data
    $query = "SELECT
                id, adress, codepostal,ville
            FROM
                " . $this->table_name . "
            ORDER BY
                adress";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}

}
?>