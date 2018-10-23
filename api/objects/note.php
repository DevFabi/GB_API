<?php
class Note{
 
    // database connection and table name
    private $conn;
    private $table_name = "note";
 
    // object properties
    public $id;
    public $note_ambiance;
    public $note_food;
    public $created;
    public $deleted;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
public function read(){
 
    //select all data
    $query = "SELECT
                id, note_ambiance,note_food
            FROM
                " . $this->table_name . "
            ORDER BY
                note_ambiance";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}

function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                note_ambiance=:note_ambiance, note_food=:note_food, created=:created";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->note_ambiance=htmlspecialchars(strip_tags($this->note_ambiance));
    $this->note_food=htmlspecialchars(strip_tags($this->note_food));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":note_ambiance", $this->note_ambiance);
    $stmt->bindParam(":note_food", $this->note_food);
    $stmt->bindParam(":created", $this->created);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}


}
?>