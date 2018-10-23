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

function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                img=:img, created=:created";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->img=htmlspecialchars(strip_tags($this->img));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":img", $this->img);
    $stmt->bindParam(":created", $this->created);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}


}
?>