<?php
class Photo{
 
    // database connection and table name
    private $conn;
    private $table_name = "photo";
 
    // object properties
    public $id;
    public $img;
    public $created;
    public $deleted;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
public function read(){
 
    //select all data
    $query = "SELECT
                id, img
            FROM
                " . $this->table_name . "
            ORDER BY
                id";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}

}
?>