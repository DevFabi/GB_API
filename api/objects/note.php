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

}
?>